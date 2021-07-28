<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(){
        
    }
}
