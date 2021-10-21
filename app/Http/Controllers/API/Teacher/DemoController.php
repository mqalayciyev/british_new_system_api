<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\DemoLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demo = DemoLesson::select('demo_lessons.*', 'offices.name as office_name',
            'lessons.title as lesson_name', DB::raw("CONCAT(student.first_name,' ',student.last_name) as student_name"),
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"))
            ->leftJoin('users as student', 'student.id', 'demo_lessons.student')
            ->leftJoin('users as teacher', 'teacher.id', 'demo_lessons.teacher')
            ->leftJoin('offices', 'offices.id', 'demo_lessons.office')
            ->leftJoin('lessons', 'lessons.id', 'demo_lessons.lesson')
            ->where('demo_lessons.company', request()->user()->company)
            ->where('demo_lessons.teacher', request()->user()->id)
            ->get();
        return response()->json(['status' => 'success', 'demo' => $demo]);
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
