<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {

        return view('front.page.login');
    }
    public function register() {

        return view('front.page.register');
    }
}
