<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\GroupLesson;
use App\Models\GroupStudent;
use App\Models\GroupStudyDay;
use App\Models\StudentLesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'office' => 'required',
            'hours' => 'required',
            'capacity' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('name', 'office', 'level', 'hours', 'teacher', 'lesson', 'capacity', 'age_category', 'type', 'price', 'status');

        $data['company'] = request()->user()->company;
        $group = GroupLesson::create($data);

        if(request()->has('selectedStudyDays') && count(request('selectedStudyDays')) > 0){
            $study_days = request('selectedStudyDays');
            for($i = 0; $i< count($study_days); $i++){
                GroupStudyDay::create([
                    'group' => $group->id,
                    strtolower($study_days[$i]['label']) => 1,
                    'company' => request()->user()->company,
                ]);
            }
        }

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
            'name' => 'required',
            'office' => 'required',
            'hours' => 'required',
            'capacity' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('name', 'office', 'level', 'hours', 'teacher', 'lesson', 'capacity', 'age_category', 'type', 'price', 'status');


        GroupLesson::where('id', $id)->update($data);
        if(request()->has('selectedStudyDays') && count(request('selectedStudyDays')) > 0 ){
            GroupStudyDay::where('group',  $id)->where('company',  request()->user()->company)->delete();
            $study_days = request('selectedStudyDays');

            for($i = 0; $i< count($study_days); $i++){
                GroupStudyDay::create([
                    'group' => $id,
                    strtolower($study_days[$i]['label']) => 1,
                    'company' => request()->user()->company,
                ]);
            }
        }
        else{
            GroupStudyDay::where('group',  $id)->where('company',  request()->user()->company)->delete();
        }
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
        GroupLesson::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }

    public function study_days ($id){
        $study_days = GroupStudyDay::where('company', request()->user()->company)->where('group', $id)->get();
        return response()->json(['status' => 'success', 'study_days' => $study_days]);
    }
    public function get_students($id){
        $group = GroupLesson::find($id);
        $groupStudents = GroupStudent::where('group', $id)->get();

        $arr = [];
        for($i=0; $i<count($groupStudents); $i++){
            array_push($arr, $groupStudents[$i]->student);
        }
        $selectedStudents = User::select('users.id', DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"))->whereIn('id', $arr)->get();
        $student = [];
        if($group){
            $student = User::select('users.id', DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"))
                ->leftJoin('student_lessons', 'student_lessons.student', 'users.id')
                ->where('users.company', request()->user()->company)
                ->where('users.type', 3)
                ->where('student_lessons.lesson', $group->lesson)
                ->where('users.office', $group->office)
                ->where('users.level', $group->level)
                ->where('users.age_category', $group->age_category)
                ->get();
        }
        return response()->json(['status' => 'success', 'students' => $student, 'selectedStudents' => $selectedStudents]);
    }
    public function add_students($id){
        if(request()->has('selectedStudents') && count(request('selectedStudents')) > 0 ){


            GroupStudent::where('group',  $id)->where('company',  request()->user()->company)->delete();
            $students = request('selectedStudents');

            for($i = 0; $i< count($students); $i++){
                GroupStudent::create([
                    'group' => $id,
                    'student' => $students[$i]['value'],
                    'company' => request()->user()->company,
                ]);
            }
        }
        else{
            GroupStudent::where('group',  $id)->where('company',  request()->user()->company)->delete();
        }
        return response()->json(['status' => 'success']);
    }
}
