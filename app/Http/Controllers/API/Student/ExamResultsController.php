<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamResult;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class ExamResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = collect(ExamResult::select('exam_results.*', 'exams.name as exam_name', 'exams.type as exam_type', 'lessons.title as lesson_name')
        ->leftJoin('exams', 'exams.id', 'exam_results.exam')
        ->leftJoin('tests', 'tests.id', 'exams.test')
        ->leftJoin('lessons', 'lessons.id', 'tests.lesson')
        ->where('exam_results.company', request()->user()->company)
        ->where('exam_results.student', request()->user()->id)
        ->get())->unique(function ($row) {
            return $row['exam'];
        });
        return response()->json(['status' => 'success', 'results' => $results]);
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
        $results = Question::select('questions.*', 'exam_results.answer as student_answer',
            'exam_results.result as student_result', 'exams.name as name', 'exams.type as type', 'lessons.title as lesson_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('answer_id', question_answers.id, 'answer_true', question_answers.true, 'answer', question_answers.answer )) ,']') AS answers"))
            ->leftJoin('tests', 'tests.id', 'questions.test')
            ->leftJoin('lessons', 'lessons.id', 'tests.lesson')
            ->leftJoin('exam_results', 'exam_results.question', 'questions.id')
            ->leftJoin('exams', 'exams.id', 'exam_results.exam')
            ->leftJoin('question_answers', 'question_answers.question', 'questions.id')
            ->where('exam_results.exam', $id)
            ->where('exam_results.student', request()->user()->id)
            ->where('exam_results.company', request()->user()->company)
            ->groupBy('questions.id', 'exam_results.id')
            ->get();
        return response()->json(['status' => 'success', 'results' => $results]);
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
