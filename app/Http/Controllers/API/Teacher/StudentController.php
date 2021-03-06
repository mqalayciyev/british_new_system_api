<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Student;
use App\Models\CorparateClient;
use App\Models\StudentLesson;
use App\Models\StudentStudyDay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = User::select('users.*', "offices.id as office_id", 'offices.name as office_name', 'private_lessons.id  as private', 'group_lessons.id  as group', 'demo_lessons.id  as demo',
            "age_categories.title as age_cat_title", "age_categories.id as age_cat_id",
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('value' , lessons.id , 'label' , lessons.title )), ']') AS lessons"),
            DB::raw("CONCAT(GROUP_CONCAT(JSON_OBJECT('id' , student_study_days.id , 'monday' , student_study_days.monday,
            'tuesday' , student_study_days.tuesday, 'wednesday', student_study_days.wednesday, 'thursday', student_study_days.thursday,
             'friday', student_study_days.friday, 'saturday', student_study_days.saturday, 'sunday', student_study_days.sunday ))) AS study_days"),
            DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"))
            ->leftJoin('student_study_days', 'student_study_days.student', 'users.id')
            ->leftJoin('offices', 'offices.id', 'users.office')
            ->leftJoin('student_lessons', 'student_lessons.student', 'users.id')
            ->leftJoin('lessons', 'lessons.id', 'student_lessons.lesson')
            ->leftJoin('age_categories', 'age_categories.id', 'users.age_category')
            ->leftJoin('group_students', 'group_students.student', 'users.id')
            ->leftJoin('group_lessons', 'group_lessons.id', 'group_students.group')
            ->leftJoin('private_lessons', 'private_lessons.student', 'users.id')
            ->leftJoin('demo_lessons', 'demo_lessons.student', 'users.id')
            ->where('users.company', request()->user()->company)
            ->whereRaw('group_lessons.teacher ='. request()->user()->id . ' OR private_lessons.teacher ='. request()->user()->id . ' OR demo_lessons.teacher ='. request()->user()->id)
            ->where('users.type', 3)
            ->groupBy('users.id', 'group_lessons.id', 'demo_lessons.id', 'private_lessons.id')
            ->get();
        return response()->json(['status' => 'success', 'students' => $student]);

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
            'permission.required'  => 'Sessia qeyd edilm??yib.',
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
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $student = User::where('email', request('email'))->where('company', request()->user()->company)->first();
        if($student){
            return response()->json(['status' => 'error', 'message' => ['Bu istifadeci sistemde movcuddur: '.  request('email')]]);
        }
        $data = $request->only('first_name', 'last_name', 'email', 'mobile', 'phone', 'date', 'gender', 'note', 'person_first_name', 'person_last_name',
            'person_relationship', 'person_mobile', 'person_email', 'intial_date', 'initial_contact', 'purpose', 'status', 'office', 'level', 'age_category',
            'learning_type', 'corparate', 'corparate', 'corparate_position');
        $data['password'] = Hash::make($request->password);
        $data['type'] = 3;
        $data['login'] = 3;
        $data['added_by'] = request()->user()->id;
        $data['company'] = request()->user()->company;
        $user = User::create($data);

        if(request()->has('selectedStudyDays') && count(request('selectedStudyDays')) > 0){
            $study_days = request('selectedStudyDays');
            $selectedStudyDays['company'] = request()->user()->company;
            for($i = 0; $i< count($study_days); $i++){
                $selectedStudyDays[$study_days[$i]['label']] = 1;
            }
            StudentStudyDay::updateOrCreate(['student' => $user->id], $selectedStudyDays);
        }
        if(request()->has('selectedLessons') && count(request('selectedLessons')) > 0 ){
            $lesson = request('selectedLessons');
            for($i = 0; $i< count($lesson); $i++){
                StudentLesson::create([
                    'student' => $user->id,
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
        $messages = [
            'permission.required'  => 'Sessia qeyd edilm??yib.',
            'email.required'  => 'Email Bos ola bilmez.',
            'email.email'  => 'Duzgun email formasi daxil edin.',
            'password.required'  => 'Sifre bos ola bilmez.',
            'password.min'  => 'Sifre minimum 8 simvol omalidir.',
        ];
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'email' => Rule::unique('users')->ignore($id),
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'office' => 'required|exists:offices,id',
            'mobile' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $user = User::where('email', request('email'))->where('company', request()->user()->company)->where('id', '!=', $id)->first();
        if($user){
            return response()->json(['status' => 'error', 'message' => ['Bu istifadeci sistemde movcuddur: '.  request('email')]]);
        }
        $data = $request->only('first_name', 'last_name', 'email', 'mobile', 'phone', 'date', 'gender', 'note', 'person_first_name', 'person_last_name',
                                'person_relationship', 'person_mobile', 'person_email', 'intial_date', 'initial_contact', 'purpose', 'status', 'office', 'level', 'age_category',
                                'learning_type', 'corparate', 'corparate', 'corparate_position');
        if($request->password !== null){
            $data['password'] = Hash::make($request->password);
        }

        $data['login'] = 3;

        User::where('id', $id)->update($data);
        $user = User::where('id', $id)->first();
        if(request()->has('selectedStudyDays') && count(request('selectedStudyDays')) > 0 ){
            StudentStudyDay::where('student',  $id)->where('company',  request()->user()->company)->delete();
            $study_days = request('selectedStudyDays');
            $selectedStudyDays['company'] = request()->user()->company;
            for($i = 0; $i< count($study_days); $i++){
                $selectedStudyDays[$study_days[$i]['label']] = 1;
            }
            StudentStudyDay::updateOrCreate(['student' => $id], $selectedStudyDays);

        }
        else{
            StudentStudyDay::where('student',  $id)->where('company',  request()->user()->company)->delete();
        }
        if(request()->has('selectedLessons') && count(request('selectedLessons')) > 0 ){
            StudentLesson::where('student',  $id)->where('company',  request()->user()->company)->delete();
            $lesson = request('selectedLessons');
            for($i = 0; $i< count($lesson); $i++){
                StudentLesson::create([
                    'student' => $id,
                    'lesson' => $lesson[$i]['value'],
                    'company' => request()->user()->company,
                ]);
            }
        }
        else{
            StudentLesson::where('student',  $id)->where('company',  request()->user()->company)->delete();
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
        return response()->json(['status' => 'success', 'message' => 'M??lumat silindi']);
    }
    public function study_days ($id){
        $study_days = StudentStudyDay::where('company', request()->user()->company)->where('student', $id)->first();
        return response()->json(['status' => 'success', 'study_days' => $study_days]);
    }
    public function lessons ($id){
        $lessons = StudentLesson::select(['student_lessons.*', 'lessons.title as lesson_name'])
            ->leftJoin('lessons', 'lessons.id', 'student_lessons.lesson')
            ->where('student_lessons.company', request()->user()->company)
            ->where('student_lessons.student', $id)->get();
        return response()->json(['status' => 'success', 'lessons' => $lessons]);
    }
}
