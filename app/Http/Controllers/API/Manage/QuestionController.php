<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'question' => 'required',
            'test' => 'required',
            'answer_true' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('test', 'question');
        $question = Question::create($data);
        QuestionAnswer::create([
            'question' => $question->id,
            'answer' => $request->answer_true,
            'answer_title' => 'answer_true',
            'true' => 1
        ]);
        for($i=1; $i<5; $i++){
            $a_t = 'answer_'.$i;
            if($request->$a_t){
                QuestionAnswer::create([
                    'question' => $question->id,
                    'answer' => $request->$a_t,
                    'answer_title' => $a_t,
                    'true' => 0
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
        $questions = Question::select('questions.*', DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id', question_answers.id, 'answer' , question_answers.answer , 'true' , question_answers.true, 'answer_title', question_answers.answer_title )) ,']') AS answers"))
        ->leftJoin('tests', 'tests.id', 'questions.test')
        ->leftJoin('question_answers', 'question_answers.question', 'questions.id')
        ->where('tests.company', request()->user()->company)
        ->where('questions.test', $id)
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
        $validator = Validator::make(request()->all(), [
            'question' => 'required',
            'test' => 'required',
            'answer_true' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('test', 'question');

        Question::where('id', $id)->update($data);
        QuestionAnswer::where('question', $id)->delete();
        QuestionAnswer::create([
            'question' => $id,
            'answer' => $request->answer_true,
            'answer_title' => 'answer_true',
            'true' => 1
        ]);
        for($i=1; $i<5; $i++){
            $a_t = 'answer_'.$i;
            if($request->$a_t){
                QuestionAnswer::create([
                    'question' => $id,
                    'answer' => $request->$a_t,
                    'answer_title' => $a_t,
                    'true' => 0
                ]);
            }
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
        Question::where('id', $id)->delete();
        QuestionAnswer::where('question', $id)->delete();
        return response()->json(['status' => 'success']);
    }
}
