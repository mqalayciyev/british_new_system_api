<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\LeadsNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadsNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'note' => 'required',
            'leads' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->all();
        LeadsNote::create($data);

        return response()->json(['status' => 'success', 'message' => 'Qeyd əlavə edildi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$id || $id == 0 || $id == null){
            return response()->json(['status' => 'error', 'message' => ['Leads tapilmadi']]);
        }
        $notes = LeadsNote::where('leads', $id)->get();
        return response()->json(['status' => 'success', 'notes' => $notes]);
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

        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'leads' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data =  $request->all();
        LeadsNote::where('id', $id)->update($data);

        return response()->json(['status' => 'success', 'message' => 'Qeyd yeniləndi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LeadsNote::where('id', $id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Qeyd silindi']);
    }
}
