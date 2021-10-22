<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        if (request()->isMethod('POST')) {
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', request('email'))->first();

            $user_count = User::where('email', request('email'))->count();
            if($user_count === 0){
                return back()->withInput()->withErrors(['email' => 'Xətalı giriş']);
            }

            $credentials = [
                'email' => request()->get('email'),
                'password' => request()->get('password'),
                'is_active' => 1,
            ];

            if (Auth::attempt($credentials, request()->has('rememberme'))) {
                return redirect()->route('account');
            } else {
                return back()->withInput()->withErrors(['email' => 'Xətalı giriş']);
            }

        }
        return view('front.page.login');
    }

    public function form()
    {
        return view('front.page.register');
    }

    public function save($id = 0)
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'email' => Rule::unique('admin')->ignore($id)
        ]);
        // return view('front.page.register');
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('login');
    }
    // public function forgot(){
    //     if (request()->isMethod('POST')) {
    //         // $admin = Admin::where('email', '=', request('email'))->first();
    //         $count =Admin::where('email', '=', request('email'))->count();

    //         if ($count == 0) {
    //             return redirect()->back()->withErrors(['email' => trans('İstifadəçi mövcud deyil')]);
    //         }

    //         $token = Str::random(60);
    //         PasswordReset::insert([
    //             'email' =>request('email'),
    //             'token' => $token,
    //             'created_at' => Carbon::now()
    //         ]);
    //         $reset = ['link' => route('manage.recovery.password', [$token, request('email')])];
    //         Mail::to(request('email'))->send(new ResetPasswordAdmin($reset));
    //         return redirect()
    //             ->route('manage.login')
    //             ->with('message_type', 'success')
    //             ->with('message', 'Məlumat emailinizə göndərildi.');
    //     }
    //     else{
    //         return view('manage.pages.forgot_password');
    //     }

    // }
    // public function recovery($token, $email){
    //     $count = PasswordReset::where('email', $email)
    //         ->where('token', $token)
    //         ->where('deleted_at', NULL)
    //         ->count();
    //     if($count > 0){
    //         return view('manage.pages.recovery_password', [
    //             'email' => $email,
    //             'token' => $token
    //         ]);
    //     }
    //     else{
    //         return redirect()
    //             ->route('manage.login')
    //             ->withErrors(['Bu link artıq mövcud deyil.']);
    //     }

    // }

    // public function change(){

    //     $this->validate(request(), [
    //         'password'              => 'required|min:6',
    //         'password_confirmation' => 'required|same:password'
    //     ]);

    //     Admin::where('email', request('email'))->update([
    //         'password' => Hash::make(request('password')),
    //     ]);

    //     PasswordReset::where('email', request('email'))
    //         ->where('token', request('token'))
    //         ->delete();

    //     return redirect()
    //             ->route('manage.login')
    //             ->with('message_type', 'success')
    //             ->with('message', 'Şifrəniz uğurla dəyişdirildi.');
    // }
}
