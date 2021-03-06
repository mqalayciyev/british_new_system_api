<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Tests;
use App\Models\ExamLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *  320.32 318.32 320.32
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam = Exam::select('exams.*', 'tests.name as test_name',
            DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"),
            DB::raw("CONCAT('[', GROUP_CONCAT(JSON_OBJECT('exam_level' , levels.title )) ,']') AS exam_levels"))
            ->leftJoin('users', 'users.id', 'exams.added_by')
            ->leftJoin('exam_levels', 'exam_levels.exam', 'exams.id')
            ->leftJoin('levels', 'levels.id', 'exam_levels.level')
            ->leftJoin('tests', 'tests.id', 'exams.test')
            ->where('exams.company', request()->user()->company)
            ->groupBy('exams.id')
            ->get();
        return response()->json(['status' => 'success', 'exam' => $exam]);
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
            'test' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('test', 'type', 'note', 'status', 'name', 'office', 'time');
        $data['company'] = request()->user()->company;
        $data['added_by'] = request()->user()->id;
        $exam = Exam::create($data);
        if(request()->has('selectedLevel') && count(request('selectedLevel')) > 0){
            $selected = request('selectedLevel');
            for($i = 0; $i< count($selected); $i++){
                ExamLevel::create([
                    'exam' => $exam->id,
                    'level' => $selected[$i]['value'],
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
            'test' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('test', 'type', 'note', 'status', 'name', 'office', 'time');

        if(request('added_by') == null){
            $data['added_by'] = request()->user()->id;
        }

        Exam::where('id', $id)->update($data);

        if(request()->has('selectedLevel') && count(request('selectedLevel')) > 0 ){
            ExamLevel::where('exam',  $id)->where('company',  request()->user()->company)->delete();
            $selected = request('selectedLevel');

            for($i = 0; $i< count($selected); $i++){
                ExamLevel::create([
                    'exam' => $id,
                    'level' => $selected[$i]['value'],
                    'company' => request()->user()->company,
                ]);
            }
        }
        else{
            ExamLevel::where('exam',  $id)->where('company',  request()->user()->company)->delete();
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
        Exam::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'M??lumat silindi']);
    }
    public function levels ($id){
        $levels = ExamLevel::select(['exam_levels.*', 'levels.title as level_title'])
            ->leftJoin('levels', 'levels.id', 'exam_levels.level')
            ->where('exam_levels.company', request()->user()->company)
            ->where('exam_levels.exam', $id)->get();
        return response()->json(['status' => 'success', 'levels' => $levels]);
    }

    public function tests(){
        $tests = Tests::where('for_exam', 1)
        ->where('company', request()->user()->company)
        ->get();
    return response()->json(['status' => 'success', 'tests' => $tests]);
    }
}
