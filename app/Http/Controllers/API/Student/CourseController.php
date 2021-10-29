<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Lesson::where('company', request()->user()->company)->where('status', 1)->get();
        return response()->json(['status' => 'success', 'courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'id.required'  => 'Əməliyyat uğursuz oldu',
        ];
        $validator = Validator::make(request()->all(), [
            'id' => 'required',
        ], $messages);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $course = Lesson::where('company', request()->user()->company)->where('id', request('id'))->first();
        // return $course->title;
        Notification::create([
            'login' => 1,
            'from' => request()->user()->id,
            'company' => request()->user()->company,
            'type' => 'apply',
            'content' => request()->user()->first_name . ' ' . request()->user()->last_name . ' ' . $course->title . ' kursuna qatılmaq istəyir. İstifadəçinin qeydi: ' . request('note'),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Müraciətiniz qəbul edildi. Kordinotarlarımmız siznlə əlaqə saxlayacaqlar.']);
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
        //
    }
}
