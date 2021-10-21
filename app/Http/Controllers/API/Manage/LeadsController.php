<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Student;
use App\Models\Leads;
use App\Models\LeadsNote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $leads = Leads::create($data);
        LeadsNote::create([
            'leads' => $leads->id,
            'note' => $request->note
        ]);

        return response()->json(['status' => 'success', 'message' => 'Leads əlavə edildi.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leads = Leads::where('id', $id)->where('company', request()->user()->company)->first();
//        $data = [
//            'first_name' => $leads->first_name,
//            'last_name' => $leads->last_name,
//            'email' => $leads->email,
//            'phone' => $leads->phone,
//            'mobile' => $leads->mobile,
//            'address' => $leads->address,
//        ];
        return request();
        return response()->json(['status' => 'success']);
    }
    public function addStudent($id)
    {
        if(strlen(request()->password) < 8){
            return response()->json(['status' => 'error', 'message' => ['Sifre minimum 8  simvol olmalidir.']]);
        }
        $leads = Leads::where('id', $id)->where('company', request()->user()->company)->first();
        $student = User::where('email', $leads->email)->where('company', request()->user()->company)->first();
        if($student){
            return response()->json(['status' => 'error', 'message' => ['Bu telebe sistemde movcuddur: '.  $leads->email]]);
        }

        $data = [
            'first_name' => $leads->first_name,
            'last_name' => $leads->last_name,
            'email' => $leads->email,
            'phone' => $leads->phone,
            'mobile' => $leads->mobile,
            'address' => $leads->address,
            'company' => $leads->company,
            'purpose' => $leads->purpose,
            'initial_contact' => $leads->source,
            'type' => 3,
            'added_by' => request()->user()->id,
            'password' => Hash::make(request()->password),
        ];
        User::create($data);
        return response()->json(['status' => 'success', 'message' => 'Tələbə əlavə edildi.']);
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
        $data = $request->except('owner', 'name', 'created_at', 'updated_at');
        $data['company'] =  $request->user()->company;
        Leads::where('id', $id)->update($data);

        return response()->json(['status' => 'success', 'message' => 'Leads yeniləndi.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Leads::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }
}
