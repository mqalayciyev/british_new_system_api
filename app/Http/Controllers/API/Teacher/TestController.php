<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Tests;
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
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'level' => 'required',
            'lesson' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('name', 'level', 'lesson', 'note', 'status', 'for_exam');
        $data['company'] = request()->user()->company;
        $data['added_by'] = request()->user()->id;
        $exam = Tests::create($data);
//        if(request()->has('selectedLevel') && count(request('selectedLevel')) > 0){
//            $selected = request('selectedLevel');
//            for($i = 0; $i< count($selected); $i++){
//                ExamLevel::create([
//                    'exam' => $exam->id,
//                    'level' => $selected[$i]['value'],
//                    'company' => request()->user()->company,
//                ]);
//            }
//        }

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
            'name' => 'required',
            'level' => 'required',
            'lesson' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->only('name', 'level', 'lesson', 'note', 'status', 'for_exam');
        $exam = Tests::where('id', $id)->update($data);
//        if(request()->has('selectedLevel') && count(request('selectedLevel')) > 0){
//            $selected = request('selectedLevel');
//            for($i = 0; $i< count($selected); $i++){
//                ExamLevel::create([
//                    'exam' => $exam->id,
//                    'level' => $selected[$i]['value'],
//                    'company' => request()->user()->company,
//                ]);
//            }
//        }

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
        //
    }
}
