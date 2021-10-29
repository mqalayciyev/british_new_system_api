<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestResult;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class TestResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = collect(TestResult::select('test_results.*', 'lessons.title as lesson_name', 'tests.name as test_name',)
        ->leftJoin('tests', 'tests.id', 'test_results.test')
        ->leftJoin('lessons', 'lessons.id', 'tests.lesson')
        ->where('test_results.company', request()->user()->company)
        ->where('test_results.student', request()->user()->id)
        ->get())->unique(function ($row) {
            return $row['test'];
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
        $results = Question::select('questions.*', 'test_results.answer as student_answer',
        'test_results.result as student_result', 'tests.name as name', 'lessons.title as lesson_name',
        DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('answer_id', question_answers.id, 'answer_true', question_answers.true, 'answer', question_answers.answer )) ,']') AS answers"))
        ->leftJoin('tests', 'tests.id', 'questions.test')
        ->leftJoin('lessons', 'lessons.id', 'tests.lesson')
        ->leftJoin('test_results', 'test_results.question', 'questions.id')
        ->leftJoin('question_answers', 'question_answers.question', 'questions.id')
        ->where('test_results.test', $id)
        ->where('test_results.student', request()->user()->id)
        ->where('test_results.company', request()->user()->company)
        ->groupBy('questions.id', 'test_results.id')
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
