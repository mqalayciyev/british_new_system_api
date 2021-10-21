<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\PrivateLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $private = PrivateLesson::select('private_lessons.*', 'offices.name as office_name',
            'levels.title as level_title', 'lessons.title as lesson_title', 'age_categories.title as age_category_title',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id' , academic_hours.id , 'minutes' , academic_hours.minutes, 'price' , academic_hours.price )), ']') AS hours_price"),
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id' , private_study_days.id , 'monday' , private_study_days.monday,
                                    'tuesday' , private_study_days.tuesday, 'wednesday', private_study_days.wednesday, 'thursday', private_study_days.thursday,
                                     'friday', private_study_days.friday, 'saturday', private_study_days.saturday, 'sunday', private_study_days.sunday )), ']') AS private_study_days"),
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"),
            DB::raw("CONCAT(students.first_name,' ',students.last_name) as student_name"))
            ->leftJoin('private_study_days', 'private_study_days.private', 'private_lessons.id')
            ->leftJoin('users as students', 'students.id', 'private_lessons.student')
            ->leftJoin('users as teacher', 'teacher.id', 'private_lessons.teacher')
            ->leftJoin('offices', 'offices.id', 'students.office')
            ->leftJoin('levels', 'levels.id', 'students.level')
            ->leftJoin('lessons', 'lessons.id', 'private_lessons.lesson')
            ->leftJoin('academic_hours', 'academic_hours.id', 'private_lessons.price')
            ->leftJoin('age_categories', 'age_categories.id', 'students.age_category')
            ->where('private_lessons.company', request()->user()->company)
            ->where('private_lessons.teacher', request()->user()->id)
            ->groupBy('private_lessons.id', 'students.id', 'academic_hours.id')
            ->get();
        return response()->json(['status' => 'success', 'private' => $private]);
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
