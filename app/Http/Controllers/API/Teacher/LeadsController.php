<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\LeadsNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Leads::select(['leads.*', DB::raw("CONCAT(users.first_name,' ',users.last_name) as owner"), DB::raw("CONCAT(leads.first_name,' ',leads.last_name) as name")])
            ->leftJoin('users', 'users.id', 'leads.assignee')
            ->where('leads.assignee', request()->user()->id)
            ->where('leads.company', request()->user()->company)
            ->get();
        return response()->json(['status' => 'success', 'leads' => $leads]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->all();
        $data['company'] =  $request->user()->company;
        $data['assignee'] =  $request->user()->id;
        $leads = Leads::create($data);
        LeadsNote::create([
            'leads' => $leads->id,
            'note' => $request->note
        ]);

        return response()->json(['status' => 'success', 'message' => 'Leads əlavə edildi']);
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = $request->all('first_name', 'last_name', 'purpose', 'mobile', 'phone', 'email', 'address', 'source');
        $data['company'] =  $request->user()->company;

        Leads::where('id', $id)->update($data);

        return response()->json(['status' => 'success', 'message' => 'Leads yeniləndi']);
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
