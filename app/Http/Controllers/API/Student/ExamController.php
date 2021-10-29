<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            ->where('levels.id', request()->user()->level)
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
        $validator = Validator::make($request->all(), [
            'exam' => 'required',
            'questions' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('exam');
        $data['student'] = request()->user()->id;
        $data['company'] = request()->user()->company;
        foreach ($request->questions as $key => $value) {
            $question = explode('_', $key)[1];
            $data['question'] = $question;
            $data['answer'] = $value;
            $answer = QuestionAnswer::find($value);
            $data['result'] = $answer->true;
            ExamResult::create($data);
        }
        return response()->json(['status' => 'success', 'message' => 'Imtahanı bitirdiniz']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $exam = Exam::select('exams.*',
        //         // 'levels.title as level_title',
        //         'tests.name as test_name',
        //         DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('question_id', questions.id, 'question' , questions.question )) ,']') AS questions"),
        //         DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('question_id', questions.id, 'answer_id', question_answers.id, 'answer', question_answers.answer )) ,']') AS answers"))
        //     ->leftJoin('exam_levels', 'exam_levels.exam', 'exams.id')
        //     ->leftJoin('levels', 'levels.id', 'exam_levels.level')
        //     ->leftJoin('tests', 'tests.id', 'exams.test')
        //     ->leftJoin('questions', 'questions.test', 'tests.id')
        //     ->leftJoin('question_answers', 'question_answers.question', 'questions.id')
        //     ->where('exams.company', request()->user()->company)
        //     ->where('exams.status', 1)
        //     ->where('exams.id', $id)
        //     ->where('levels.id', request()->user()->level)
        //     ->groupBy('exams.id', 'question_answers.question')
        //     ->first();
        // return response()->json(['status' => 'success', 'exam' => $exam]);
        $result = ExamResult::where('exam', $id)->where('student', request()->user()->id)->where('company', request()->user()->company)->first();

        if($result){
            return response()->json(['status' => 'error', 'message' => 'Siz bu imtahanı bitirmisiniz']);
        }

        $exam = Exam::select('exams.*',
                'levels.title as level_title',
                'tests.name as test_name',)
            ->leftJoin('exam_levels', 'exam_levels.exam', 'exams.id')
            ->leftJoin('levels', 'levels.id', 'exam_levels.level')
            ->leftJoin('tests', 'tests.id', 'exams.test')
            ->where('exams.company', request()->user()->company)
            ->where('exams.status', 1)
            ->where('exams.id', $id)
            ->where('levels.id', request()->user()->level)
            ->first();
        $questions = Question::select('questions.*',
            DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('answer_id', question_answers.id, 'answer', question_answers.answer )) ,']') AS answers"))
            ->leftJoin('tests', 'tests.id', 'questions.test')
            ->leftJoin('question_answers', 'question_answers.question', 'questions.id')
            ->where('tests.id', $exam->test)
            ->groupBy('questions.id')
            ->get();
        return response()->json(['status' => 'success', 'exam' => $exam, 'questions' => $questions]);
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
