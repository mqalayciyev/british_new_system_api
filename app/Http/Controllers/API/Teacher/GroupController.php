<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\GroupLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = GroupLesson::select('group_lessons.*', 'group_lessons.name as group_name', 'offices.name as office_name',
            'levels.title as level_title', 'lessons.title as lesson_title', 'age_categories.title as age_category_title', 'students.first_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id' , students.id , 'name' , CONCAT(students.first_name,' ',students.last_name) )), ']') AS students"),
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id' , academic_hours.id , 'minutes' , academic_hours.minutes, 'price' , academic_hours.price )), ']') AS hours_price"),
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id' , group_study_days.id , 'monday' , group_study_days.monday,
                                    'tuesday' , group_study_days.tuesday, 'wednesday', group_study_days.wednesday, 'thursday', group_study_days.thursday,
                                     'friday', group_study_days.friday, 'saturday', group_study_days.saturday, 'sunday', group_study_days.sunday )), ']') AS group_study_days"),
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"))
            ->leftJoin('group_study_days', 'group_study_days.group', 'group_lessons.id')
            ->leftJoin('group_students', 'group_students.group', 'group_lessons.id')
            ->leftJoin('users as students', 'students.id', 'group_students.student')
            ->leftJoin('users as teacher', 'teacher.id', 'group_lessons.teacher')
            ->leftJoin('offices', 'offices.id', 'group_lessons.office')
            ->leftJoin('levels', 'levels.id', 'group_lessons.level')
            ->leftJoin('lessons', 'lessons.id', 'group_lessons.lesson')
            ->leftJoin('academic_hours', 'academic_hours.id', 'group_lessons.price')
            ->leftJoin('age_categories', 'age_categories.id', 'group_lessons.age_category')
            ->where('group_lessons.company', request()->user()->company)
            ->where('group_lessons.teacher', request()->user()->id)
            ->groupBy('group_lessons.id', 'students.id', 'academic_hours.id')
            ->get();
        return response()->json(['status' => 'success', 'groups' => $groups]);
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
