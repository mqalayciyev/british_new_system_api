<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::select('attendances.*', 'lessons.title as lesson_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(JSON_OBJECT('id' , attendance_days.id, 'created_at', attendance_days.created_at, 'status', attendance_days.status)), ']') AS attendance_days"),
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"),
            DB::raw("CONCAT(students.first_name,' ',students.last_name) as student_name"))
        ->leftJoin('attendance_days', 'attendance_days.attendance', 'attendances.id')
        ->leftJoin('users as students', 'students.id', 'attendances.student')
        ->leftJoin('lessons', 'lessons.id', 'attendances.lesson')
        ->leftJoin('users as teacher', 'teacher.id', 'attendances.teacher')
        ->where('attendances.student', request()->user()->id)
        ->where('attendances.company', request()->user()->company)
        ->groupBy('attendances.id')
        ->get();

        return response()->json(['status' => 'success', 'attendance' => $attendance]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
