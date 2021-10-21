<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam = Exam::select('exams.*', 'levels.title as level_title', 'tests.name as test_name',
            DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"))
            ->leftJoin('users', 'users.id', 'exams.added_by')
            ->leftJoin('exam_levels', 'exam_levels.exam', 'exams.id')
            ->leftJoin('levels', 'levels.id', 'exam_levels.level')
            ->leftJoin('tests', 'tests.id', 'exams.test')
            ->where('exams.company', request()->user()->company)
            ->where('exams.status', 1)
            ->get();
        return response()->json(['status' => 'success', 'exams' => $exam]);
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
