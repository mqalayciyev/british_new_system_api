<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Models\Tests;
use App\Models\TestResult;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Tests::select('tests.*', 'levels.title as level_title', 'lessons.title as lesson_title',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id' , questions.id )), ']') AS questions_count"),
            DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"))
            ->leftJoin('users', 'users.id', 'tests.added_by')
            ->leftJoin('levels', 'levels.id', 'tests.level')
            ->leftJoin('lessons', 'lessons.id', 'tests.lesson')
            ->leftJoin('questions', 'questions.test', 'tests.id')
            ->where('tests.company', request()->user()->company)
            ->where('tests.status', 1)
            ->where('tests.for_exam', 0)
            ->groupBy('tests.id')
            ->get();
        return response()->json(['status' => 'success', 'tests' => $tests]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test' => 'required',
            'questions' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('test');
        $data['student'] = request()->user()->id;
        $data['company'] = request()->user()->company;
        foreach ($request->questions as $key => $value) {
            $question = explode('_', $key)[1];
            $data['question'] = $question;
            $data['answer'] = $value;
            $answer = QuestionAnswer::find($value);
            $data['result'] = $answer->true;
            TestResult::create($data);
        }
        return response()->json(['status' => 'success', 'message' => 'Testi bitirdiniz']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::select('questions.*', 'tests.name as test_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('answer_id', question_answers.id, 'answer', question_answers.answer )) ,']') AS answers"))
            ->leftJoin('tests', 'tests.id', 'questions.test')
            ->leftJoin('question_answers', 'question_answers.question', 'questions.id')
            ->where('tests.id', $id)
            ->groupBy('questions.id')
            ->get();
        return response()->json(['status' => 'success', 'questions' => $questions]);
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
    public function test_end() {

    }
}
