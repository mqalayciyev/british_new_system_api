<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcement = Announcement::select('announcements.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) as user_name"))->leftJoin('users', 'users.id', 'announcements.user')
            ->where('announcements.company', request()->user()->company)->get();
        return response()->json(['status' => 'success', 'announcements' => $announcement]);
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
            'note' => 'required',
            'share_with' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = request()->except( 'share_with');
        $data['company'] = request()->user()->company;
        $data['user'] =  request()->user()->id;
        $shareWith = $request->share_with;
        $data['teacher'] = 0;
        $data['manager'] = 0;
        $data['student'] = 0;
        for ($i = 0; $i<count($shareWith); $i++){

            if($shareWith[0]['value'] == 1){
                $data['teacher'] = 1;
                $data['manager'] = 1;
                $data['student'] = 1;
            }
            else{
                $data[strtolower($shareWith[$i]['label'])] = 1;
            }

        }
        Announcement::create($data);
        return response()->json(['status' => 'success', 'message' => 'Elan əlavə edildi.']);
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
        $validator = Validator::make(request()->all(), [
            'note' => 'required',
            'share_with' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = request()->only( 'note', 'status');
        $shareWith = $request->share_with;
        $data['teacher'] = 0;
        $data['manager'] = 0;
        $data['student'] = 0;
        for ($i = 0; $i<count($shareWith); $i++){
            if($shareWith[0]['value'] == 1){
                $data['teacher'] = 1;
                $data['manager'] = 1;
                $data['student'] = 1;
            }
            else{
                $data[strtolower($shareWith[$i]['label'])] = 1;
            }

        }
//        return $data;
        Announcement::where('id', $id)->update($data);
        return response()->json(['status' => 'success', 'message' => 'Elan yeniləndi.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }
}
