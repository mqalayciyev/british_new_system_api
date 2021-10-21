<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        function left_join_array($left, $right, $left_join_on, $right_join_on = NULL){
//            $final= array();
//
//            if(empty($right_join_on))
//                $right_join_on = $left_join_on;
//
//            foreach($left AS $k => $v){
//                $final[$k] = $v;
//                foreach($right AS $kk => $vv){
//                    if($v[$left_join_on] == $vv[$right_join_on]){
//                        foreach($vv AS $key => $val)
//                            $final[$k][$key] = $val;
//                    } else {
//                        foreach($vv AS $key => $val)
//                            $final[$k][$key] = NULL;
//                    }
//                }
//            }
//            return $final;
//        }
        $evaluation = Evaluation::leftJoin('users as users1', 'users1.id', 'evaluations.student')
            ->leftJoin('users as users2', 'users2.id', 'evaluations.teacher')
            ->leftJoin('offices', 'offices.id', 'users1.office')
            ->select(['evaluations.*', DB::raw("offices.name as office_name"), DB::raw("CONCAT(users1.first_name,' ',users1.last_name) as student_name"), DB::raw("CONCAT(users2.first_name,' ',users2.last_name) as teacher_name")])
            ->where('evaluations.company', request()->user()->company)
            ->get();
        return response()->json(['status' => 'success', 'evaluation' => $evaluation]);
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
