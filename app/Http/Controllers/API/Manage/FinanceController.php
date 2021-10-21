<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\GroupLesson;
use App\Models\Payment;
use App\Models\PrivateLesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::select('payments.*', 'lessons.title as lesson_title', 'offices.name as office_name', DB::raw("CONCAT(users.first_name,' ',users.last_name) as student_name"))
            ->leftJoin('lessons', 'lessons.id', 'payments.lesson')
            ->leftJoin('users', 'users.id', 'payments.payer')
            ->leftJoin('offices', 'offices.id', 'payments.office')
            ->where('payments.company', request()->user()->company)
            ->get();
        return response()->json(['status' => 'success', 'payments' => $payments]);
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
            'payer' => 'required',
            'lesson' => 'required',
            'payment_value' => 'required',
            'payment_date' => 'required',
        ]);




        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $groups = GroupLesson::select('group_lessons.*', 'academic_hours.price as ace_price', 'academic_hours.minutes as ace_min')
            ->leftJoin('group_students', 'group_students.group', 'group_lessons.id')
            ->leftJoin('academic_hours', 'academic_hours.id', 'group_lessons.price')
            ->leftJoin('users as students', 'students.id', 'group_students.student')
            ->leftJoin('offices', 'offices.id', 'group_lessons.office')
            ->leftJoin('levels', 'levels.id', 'group_lessons.level')
            ->leftJoin('lessons', 'lessons.id', 'group_lessons.lesson')
            ->where('group_lessons.company', request()->user()->company)
            ->where('group_lessons.lesson', request()->lesson)
            ->where('group_students.student', request()->payer)
            ->first();
        if($groups){
            $price = $groups->hours*60*$groups->ace_price / $groups->ace_min;
        }
        $private = PrivateLesson::select('private_lessons.*', 'academic_hours.price as ace_price', 'academic_hours.minutes as ace_min' )
            ->leftJoin('users as students', 'students.id', 'private_lessons.student')
            ->leftJoin('academic_hours', 'academic_hours.id', 'private_lessons.price')
            // ->leftJoin('offices', 'offices.id', 'private_lessons.office')
            // ->leftJoin('levels', 'levels.id', 'private_lessons.level')
            ->leftJoin('lessons', 'lessons.id', 'private_lessons.lesson')
            ->where('private_lessons.company', request()->user()->company)
            ->first();

        if($private){
            $price = $private->hours*60*$private->ace_price / $private->ace_min;
        }
        $student = User::find($request->payer);

        $due = $request->payment_value - $price;

        $data = $request->all();
        $data['status'] = $due >= 0 ? 'Paid' : 'Incompletely paid';
        $data['price'] = $price;
        $data['office'] = $student->office;
        $data['payment_due'] = $due;
        $data['company'] = request()->user()->company;
        Payment::create($data);


        return response()->json(['status' => 'success', 'message' => 'Ödəniş məlumatları əlavə edildi.']);

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
        $validator = Validator::make(request()->all(), [
            'office' => 'required',
            'payer' => 'required',
            'status' => 'required',
            'lesson' => 'required',
            'payment_value' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $groups = GroupLesson::select('group_lessons.*', 'academic_hours.price as ace_price', 'academic_hours.minutes as ace_min')
            ->leftJoin('group_students', 'group_students.group', 'group_lessons.id')
            ->leftJoin('academic_hours', 'academic_hours.id', 'group_lessons.price')
            ->leftJoin('users as students', 'students.id', 'group_students.student')
            ->leftJoin('offices', 'offices.id', 'group_lessons.office')
            ->leftJoin('levels', 'levels.id', 'group_lessons.level')
            ->leftJoin('lessons', 'lessons.id', 'group_lessons.lesson')
            ->where('group_lessons.company', request()->user()->company)
            ->where('group_lessons.lesson', request()->lesson)
            ->where('group_students.student', request()->payer)
            ->first();
        if($groups){
            $price = $groups->hours*60*$groups->ace_price / $groups->ace_min;
        }
        $private = PrivateLesson::select('private_lessons.*', 'academic_hours.price as ace_price', 'academic_hours.minutes as ace_min' )
            ->leftJoin('users as students', 'students.id', 'private_lessons.student')
            ->leftJoin('academic_hours', 'academic_hours.id', 'private_lessons.price')
            // ->leftJoin('offices', 'offices.id', 'private_lessons.office')
            // ->leftJoin('levels', 'levels.id', 'private_lessons.level')
            ->leftJoin('lessons', 'lessons.id', 'private_lessons.lesson')
            ->where('private_lessons.company', request()->user()->company)
            ->first();

        if($private){
            $price = $private->hours*60*$private->ace_price / $private->ace_min;
        }
        $student = User::find($request->payer);
        $due = $request->payment_value - $price;
        $data = $request->only('payer', 'lesson', 'payment_value', 'note', 'payment_date');
        $data['status'] = $due >= 0 ? 'Paid' : 'Incompletely paid';

        $data['price'] = $price;
        $data['office'] = $student->office;
        $data['payment_due'] = $due;

        Payment::where('id', $id)->update($data);


        return response()->json(['status' => 'success', 'message' => 'Ödəniş məlumatları yeniləndi.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }

    public function due()
    {
        $payments = Payment::select('payments.*', 'lessons.title as lesson_title', 'users.email as student_email', 'users.status as student_status',
                    'users.mobile as student_mobile', 'offices.name as office_name', DB::raw("CONCAT(users.first_name,' ',users.last_name) as student_name"))
            ->leftJoin('lessons', 'lessons.id', 'payments.lesson')
            ->leftJoin('users', 'users.id', 'payments.payer')
            ->leftJoin('offices', 'offices.id', 'payments.office')
            ->where('payments.company', request()->user()->company)
            ->where('payments.payment_due', '<', 0)
            ->get();
        return response()->json(['status' => 'success', 'payments' => $payments]);
    }
}
