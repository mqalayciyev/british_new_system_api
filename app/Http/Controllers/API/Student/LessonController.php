<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons_g = StudentLesson::select('student_lessons.*', 'offices.name as office_name', 'learning_types.title as learning_type', 'age_categories.title as age_category',
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"),
            DB::raw("CONCAT(GROUP_CONCAT(JSON_OBJECT('id' , group_study_days.id , 'monday' , group_study_days.monday,
                                    'tuesday' , group_study_days.tuesday, 'wednesday', group_study_days.wednesday, 'thursday', group_study_days.thursday,
                                     'friday', group_study_days.friday, 'saturday', group_study_days.saturday, 'sunday', group_study_days.sunday ))) AS study_days"),
            'group_lessons.name as group_name', 'group_lessons.hours as hours', 'lessons.title as lesson_title',
            'academic_hours.price as price', 'academic_hours.minutes as minutes', 'levels.title as level_title', 'companies.currency as currency')
            ->leftJoin('lessons', 'lessons.id', 'student_lessons.lesson')
            ->leftJoin('group_lessons', 'group_lessons.lesson', 'lessons.id')
            ->leftJoin('levels', 'levels.id', 'group_lessons.level')
            ->leftJoin('academic_hours', 'academic_hours.id', 'group_lessons.price')
            ->leftJoin('age_categories', 'age_categories.id', 'group_lessons.age_category')
            ->leftJoin('group_study_days', 'group_study_days.group', 'group_lessons.id')
            ->leftJoin('learning_types', 'learning_types.id', 'group_lessons.type')
            ->leftJoin('group_students', 'group_students.group', 'group_lessons.id')
            ->leftJoin('users as teacher', 'teacher.id', 'group_lessons.teacher')
            ->leftJoin('users', 'users.id', 'student_lessons.student')
            ->leftJoin('companies', 'companies.id', 'users.company')
            ->leftJoin('offices', 'offices.id', 'users.office')
            ->where('student_lessons.student', request()->user()->id)
            ->where('group_students.student', request()->user()->id)
            ->groupBy('student_lessons.id', 'group_lessons.id')
            ->get();
        $lessons_p = StudentLesson::select('student_lessons.*', 'offices.name as office_name', 'age_categories.title as age_category',
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"),
            DB::raw("CONCAT(GROUP_CONCAT(JSON_OBJECT('id' , private_study_days.id , 'monday' , private_study_days.monday,
                                    'tuesday' , private_study_days.tuesday, 'wednesday', private_study_days.wednesday, 'thursday', private_study_days.thursday,
                                     'friday', private_study_days.friday, 'saturday', private_study_days.saturday, 'sunday', private_study_days.sunday ))) AS study_days"),
            'lessons.title as lesson_title',  'private_lessons.hours as hours',
            'academic_hours.price as price', 'academic_hours.minutes as minutes', 'levels.title as level_title', 'companies.currency as currency')
            ->leftJoin('lessons', 'lessons.id', 'student_lessons.lesson')
            ->leftJoin('private_lessons', 'private_lessons.lesson', 'lessons.id')

            ->leftJoin('academic_hours', 'academic_hours.id', 'private_lessons.price')
            ->leftJoin('private_study_days', 'private_study_days.private', 'private_lessons.id')
            ->leftJoin('users as teacher', 'teacher.id', 'private_lessons.teacher')
            ->leftJoin('users', 'users.id', 'student_lessons.student')
            ->leftJoin('companies', 'companies.id', 'users.company')
            ->leftJoin('age_categories', 'age_categories.id', 'users.age_category')
            ->leftJoin('levels', 'levels.id', 'users.level')
            ->leftJoin('offices', 'offices.id', 'users.office')
            ->where('student_lessons.student', request()->user()->id)
            ->where('private_lessons.student', request()->user()->id)
            ->groupBy('student_lessons.id', 'private_lessons.id')
            ->get();
        $lessons_d = StudentLesson::select('student_lessons.*', 'offices.name as office_name', 'demo_lessons.date as lesson_date',
            DB::raw("CONCAT(teacher.first_name,' ',teacher.last_name) as teacher_name"),
            'lessons.title as lesson_title')
            ->leftJoin('lessons', 'lessons.id', 'student_lessons.lesson')
            ->leftJoin('demo_lessons', 'demo_lessons.lesson', 'lessons.id')
            ->leftJoin('users as teacher', 'teacher.id', 'demo_lessons.teacher')
            ->leftJoin('offices', 'offices.id', 'demo_lessons.office')
            ->where('student_lessons.student', request()->user()->id)
            ->where('demo_lessons.student', request()->user()->id)
            ->get();
        return response()->json(['status' => 'success', 'lessons_g' => $lessons_g, 'lessons_p' => $lessons_p, 'lessons_d' => $lessons_d]);
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
