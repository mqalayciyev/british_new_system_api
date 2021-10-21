<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    function createSlug($str) {
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
        $media = Media::select('media.*', DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"))
            ->leftJoin('users', 'users.id', 'media.assignee')
            ->where('media.company', request()->user()->company)
            ->get();
        return response()->json(['status' => 'success', 'media' => $media]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if($request->type == 'book'){
            $rules = 'required|mimes:doc,docx,pdf';
        }
        if($request->type == 'video'){
            $rules = 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,mpeg|max:102400';
        }
        if($request->type == 'audio'){
            $rules = 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav';
        }
        if($request->type == 'image'){
            $rules = 'required|mimes:jpeg,png,jpg,gif';
        }
        $validator = Validator::make($request->all(), [
            'file' => $rules,
            'title' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }


        $company = Company::find($request->user()->company);
        $file = $request->file('file');

        $data = $request->all();

        $path = public_path().'/assets/' . $this->createSlug($company->name) . '/media';
        if (!File::exists($path))
        {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $name= $this->createSlug($company->name) . '_'.$request->type.'_' .time().'.'.$file->getClientOriginalExtension();
        $request->file->move('assets/' . $this->createSlug($company->name) . '/media/', $name);
        $file_url = asset('assets/' . $this->createSlug($company->name) . '/media');
        $url = $file_url . '/' .$name;
        $data['file'] = $url;
        $data['company'] = $request->user()->company;
        $data['assignee'] = $request->user()->id;
        Media::create($data);
        return response()->json(['status' => 'success', 'message' => "Məlumat sistemə əlavə edildi."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('title', 'note');
        Media::where('id', $id)->update($data);
        return response()->json(['status' => 'success', 'message' => 'Məlumat yeniləndi.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::where('id', $id)->first();
        $company = Company::find(request()->user()->company);
        $file = explode('/', $media->file);
        $count = count($file);
        // Storage::delete('assets/'.createSlug($company->name).'/media/'.$file[$count-1]);
        if(File::exists(public_path('assets/' . $this->createSlug($company->name).'/profile/'.$file[$count-1]) ) ){

            File::delete(public_path('assets/' . $this->createSlug($company->name).'/profile/'.$file[$count-1]) );

        }

        Media::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }
}
