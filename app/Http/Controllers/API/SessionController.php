<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use App\Models\Office;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $response = [
            'success' => true,
            'data' => "data",
            'message' => 'Your custom success message',
        ];
        return response()->json($response, 200);
//        return response()->json(["{'status': 'error', 'message': 'Istifadəçi tapılmadı'}"]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function control(Request $request) {
        if(Auth::check()){
            $user = Auth::user();
            return response()->json(['status' => 'success', 'session' => ['user' => $user]]);
        }
        else{
            return response()->json(['status' => 'error']);
        }
    }
    public function store(Request $request)
    {

        // return response()->json('ok');



        $messages = [
            'email.required'  => 'Email Bos ola bilmez.',
            'email.email'  => 'Duzgun email formasi daxil edin.',
            'email.min'  => 'email minumum 9simvol omalidir.',
            'password.required'  => 'Sifre bos ola bilmez.',
            'password.min'  => 'Sifre minimum 8 simvol olmalidir.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:9',
            'password' => 'required|min:8',
        ], $messages);




        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }





        $users = User::where('email', request('email'))->where('login', $request->login)->where('status', 1)->first();
        if(!$users){
            return response()->json(['status' => 'error', 'message' => ['Bu emailə uyğun istifadəçi tapılmadı.']]);
        }

        $office = Office::where('company', $users->company)->where('id', $users->office)->where('status',1)->first();
        $company = Company::where('id', $users->company)->where('is_active', 1)->first();



        if(!$company){
            return response()->json(['status' => 'warning', 'message' => ['Bu şirkət hal hazırda aktiv deyil.']]);
        }

        if($users->email_verified !== null){
            return response()->json(['status' => 'warning', 'message' => ['Zəhmət olmasa emaili təsdiqləyin.']]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'login' => request('login'),
            'status' => 1,
            'type' => $users->type,
            'company' => $users->company,
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json(['status' => 'error', 'message' => ['Unauthorized']]);
        }


        $user = $request->user();

        $tokenRes = $user->createToken('User Logged');
        // return response()->json(["{'status': $user}"]);
        $token = $tokenRes->token;
        // return response()->json(["{'status': $user}"]);
        if(request()->has('rememberme')){
            $token->expires_at = Carbon::now()->addWeeks(1);
        }if(request()->has('rememberme')){
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        else{
            $token->expires_at = Carbon::now()->addDays(1);
        }
        $token->save();
        $success['token'] = $tokenRes->accessToken;
        $success['token_type'] = 'Bearer';
        $success['user_id'] = $user->id;
        $success['user_info'] = $users;
        $success['expiry'] = Carbon::parse($tokenRes->token->expires_at)->toDateTimeString();
        return response()->json(['status' => 'success', 'session' => ['user' => $success, 'company' => $company, 'office' => $office]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['status' => 'error', 'message' => 'Istifadəçi tapılmadı']);
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
        return response()->json(['status' => 'error', 'message' => 'Istifadəçi tapılmadı']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function logoutApi (Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['status' => 'sign_out', 'message' => 'Successfully logged out']);
    }

}
