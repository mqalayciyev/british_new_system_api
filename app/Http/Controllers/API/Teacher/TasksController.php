<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Tasks::where('company', request()->user()->company)->where('assignee', request()->user()->id)->where('status', 0)->get();
        return response()->json(['status' => 'success', 'tasks' => $tasks]);
    }
    public function completed(){
        $tasks = Tasks::where('company', request()->user()->company)->where('assignee', request()->user()->id)->where('status', 2)->get();
        return response()->json(['status' => 'success', 'tasks' => $tasks]);
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
            'priority' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('start_date', 'start_time', 'end_date', 'end_time', 'priority', 'client', 'purpose', 'email', 'mobile', 'note');
        $data['status'] = 1;
        $data['company'] = request()->user()->company;
        $data['assignee'] = request()->user()->id;
        Tasks::create($data);

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
            'priority' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('start_date', 'start_time', 'end_date', 'end_time', 'priority', 'client', 'purpose', 'email', 'mobile', 'note');
        Tasks::where('id', $id)->update($data);

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tasks::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }
    public function status($id){
        Tasks::where('company', request()->user()->company)->where('id', $id)->update([
            'status' => 2
        ]);
        return response()->json(['status' => 'success']);
    }
}
