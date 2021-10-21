<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class MessagesController extends Controller
{
    function createSlug($str)
    {
        $search = array('ə', 'Ə', 'ç', 'Ç', 'Ș', 'ü', 'Ü', 'ö', 'Ö', 'ğ', 'Ğ', 'ı', 'Ț', 'ş', 'ţ', 'Ş', 'Ţ', 'ș', 'ț', 'î', 'â', 'ă', 'Î', 'Â', 'Ă', 'ë', 'Ë');
        $replace = array('e', 'E', 'c', 'C', 's', 'u', 'U', 'o', 'O', 'g', 'G', 'i', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E');
        $str = str_ireplace($search, $replace, strtolower(trim($str)));
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $str = str_replace(' ', '-', $str);
        return preg_replace('/\-{2,}/', '-', $str);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection  = collect(Messages::select([
            'messages.*', 'users1.image as user1_image', 'users2.image as user2_image', 'users1.id as user1_id', 'users2.id as user2_id',
            DB::raw("CONCAT(users1.first_name,' ',users1.last_name) as user_1"), DB::raw("CONCAT(users2.first_name,' ',users2.last_name) as user_2")
        ])
            ->leftJoin('users as users1', 'users1.id', 'messages.sender')
            ->leftJoin('users as users2', 'users2.id', 'messages.receiving')
            ->whereRaw('messages.sender=' . request()->user()->id . ' OR messages.receiving = ' . request()->user()->id)
            ->where('messages.company', request()->user()->company)
            ->where('messages.status', 2)
            ->orderByDesc('messages.created_at')
            ->get());
        $messages = $collection->unique(function ($item) {
            return $item['sender'] . $item['receiving'];
        });

        return response()->json(['status' => 'success', 'messages' => $messages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'userid' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('message');
        if (!$request->hasFile('file') && !$request->message) {
            return response()->json(['status' => 'error', 'message' => ['Mesaj bos ola bilmez']]);
        }
        if ($request->hasFile('file')) {

            $company = Company::find($request->user()->company);
            $file = $request->file('file');

            $path = public_path() . '/assets/' . $this->createSlug($company->name) . '/message_files';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $name = strtolower($request->user()->first_name) . '_' . strtolower($request->user()->last_name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $request->file->move('assets/' . $this->createSlug($company->name), $name);
            $data['file_url'] = asset('assets/' . $this->createSlug($company->name) . '/message_files');
            $data['file_name'] = $name;

            //            return response()->download(storage_path('app/public/files/' . slugify($company->name) . '/' . $name));

        }
        $data['company'] = $request->user()->company;
        $data['sender'] = $request->user()->id;
        $data['receiving'] = $request->userid;
        //        return $data;
        Messages::create($data);

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Messages::where('company', request()->user()->company)->where('sender', $id)->update(['status' => 1]);
        $messages = collect(Messages::select(['messages.*', 'users1.image as user1_image', 'users2.image as user2_image', 'users1.id as user1_id', 'users2.id as user2_id', DB::raw("CONCAT(users1.first_name,' ',users1.last_name) as user_1"), DB::raw("CONCAT(users2.first_name,' ',users2.last_name) as user_2")])
            ->leftJoin('users as users1', 'users1.id', 'messages.sender')
            ->leftJoin('users as users2', 'users2.id', 'messages.receiving')
            ->whereRaw('messages.sender = ' . $id . ' AND messages.receiving = ' .  request()->user()->id . ' OR messages.sender = ' . request()->user()->id . ' AND messages.receiving = ' . $id)
            ->where('messages.company', request()->user()->company)
            ->orderByDesc('messages.created_at')
            ->get());
        $user = User::select('users.*', DB::raw("CONCAT(users.first_name,' ',users.last_name) as name"))
            ->where('company', request()->user()->company)
            ->where('id', $id)
            ->first();
        return response()->json(['status' => 'success', 'chat' => $messages, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Messages::whereRaw('sender = ' . $id . ' AND receiving = ' .  request()->user()->id . ' OR sender = ' . request()->user()->id . ' AND receiving = ' . $id)
            ->where('messages.company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }
    public function count_messages () {
        $count = Messages::select(['messages.*'])
            ->where('messages.receiving', request()->user()->id)
            ->where('messages.company', request()->user()->company)
            ->where('messages.status', 0)
            ->count();

        return response()->json(['status' => 'success', 'count' => $count]);
    }
}
