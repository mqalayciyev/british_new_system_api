<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Assignee;
use App\Models\Manager;
use App\Models\Teacher;
use App\Models\TeacherLesson;
use App\Models\TeacherLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AcademicStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $teachers = User::select('users.*', 'offices.name as office_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('value' , lessons.id , 'label' , lessons.title )), ']') AS lessons1,
                            CONCAT('[', GROUP_CONCAT(DISTINCT  JSON_OBJECT('value' , levels.id , 'label' , levels.title )), ']') AS levels1"))
            ->leftJoin('offices', 'offices.id', 'users.office')
            ->leftJoin('teacher_payments', 'teacher_payments.id', 'users.salary')
            ->leftJoin('teacher_levels', 'teacher_levels.teacher', 'users.id')
            ->leftJoin('levels', 'levels.id', 'teacher_levels.level')
            ->leftJoin('teacher_lessons', 'teacher_lessons.teacher', 'users.id')
            ->leftJoin('lessons', 'lessons.id', 'teacher_lessons.lesson')
            ->where('users.company', request()->user()->company)
            ->where('users.type', 2)
            ->groupBy('users.id')
            ->get();
        return response()->json(['status' => 'success', 'teachers' => $teachers]);
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
            'permission.required'  => 'Sessia qeyd edilməyib.',
            'email.required'  => 'Email Bos ola bilmez.',
            'email.email'  => 'Duzgun email formasi daxil edin.',
            'password.required'  => 'Sifre bos ola bilmez.',
            'password.min'  => 'Sifre minimum 8 simvol omalidir.',
        ];
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'office' => 'required|exists:offices,id',
            'mobile' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $user = User::where('email', request('email'))->where('company', request()->user()->company)->first();
        if($user){
            return response()->json(['status' => 'error', 'message' => ['Bu istifadeci sistemde movcuddur: '.  request('email')]]);
        }

        $data = request()->except( 'levels', 'lessons');
        $data['company'] = request()->user()->company;
        $data['login'] = 2;
        $data['added_by'] = request()->user()->id;
        $data['password'] = Hash::make(request('password'));
        $user = User::create($data);

        if(request()->has('levels') && count(request('levels')) > 0){
            $level = request('levels');
            for($i = 0; $i< count($level); $i++){
                TeacherLevel::create([
                    'teacher' => $user->id,
                    'level' => $level[$i]['value'],
                    'company' => request()->user()->company,
                ]);
            }
        }
        if(request()->has('lessons') && count(request('lessons')) > 0 ){
            $lesson = request('lessons');
            for($i = 0; $i< count($lesson); $i++){
                TeacherLesson::create([
                    'teacher' => $user->id,
                    'lesson' => $lesson[$i]['value'],
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
        if($id > 0){
            $teacher = User::where('id', $id)->where('company', request()->user()->company)->first();
            return response()->json(['status' => 'success', 'teacher' => $teacher]);
        }
        else{
            return response()->json(['status' => 'error', 'message' => 'Istifadeci tapilmadi']);
        }
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
            'email' => 'required|email',
            'email' => Rule::unique('users')->ignore($id),
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'office' => 'required|exists:offices,id',
            'mobile' => 'required',
            'type' => 'required',
            'salary' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $user = User::where('email', request('email'))->where('company', request()->user()->company)->where('id', '!=', $id)->first();
        if($user){
            return response()->json(['status' => 'error', 'message' => ['Bu istifadeci sistemde movcuddur: '.  request('email')]]);
        }

        $data = $request->except('levels', 'lessons', 'password', 'office_name', 'lessons1', 'levels1', 'name', 'created_at', 'deleted_at', 'updated_at');
        if($request->password !== null && strlen($request->password) < 8){
            return response()->json(['status' => 'error', 'message' => ['The password must be at least 8 characters long.']]);
        }
        if($request->password !== null){
            $data['password'] = Hash::make($request->password);
        }
        $data['login'] = 2;
        // return response()->json($data);
        User::where('id', $id)->update($data);

        if(request()->has('levels') && count(request('levels')) > 0 ){
            TeacherLevel::where('teacher',  $id)->where('company',  request()->user()->company)->delete();
            $level = request('levels');

            for($i = 0; $i< count($level); $i++){
                TeacherLevel::create([
                    'teacher' => $id,
                    'level' => $level[$i]['value'],
                    'company' => request()->user()->company,
                ]);
            }
        }
        else{
            TeacherLevel::where('teacher',  $id)->where('company',  request()->user()->company)->delete();
        }
        if(request()->has('lessons') && count(request('lessons')) > 0 ){
            TeacherLesson::where('teacher',  $id)->where('company',  request()->user()->company)->delete();
            $lesson = request('lessons');
            for($i = 0; $i< count($lesson); $i++){
                TeacherLesson::create([
                    'teacher' => $id,
                    'lesson' => $lesson[$i]['value'],
                    'company' => request()->user()->company,
                ]);
            }
        }
        else{
            TeacherLesson::where('teacher',  $id)->where('company',  request()->user()->company)->delete();
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
        User::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }
}
