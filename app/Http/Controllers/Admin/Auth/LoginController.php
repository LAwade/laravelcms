<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function authenticate(Request $request){
        $data = $request->only(['email', 'password']);
        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:150|min:10',
            'password' => 'required|string|max:20|min:5'
        ]);
        $remember = $request->input('remember', false);

        if($validator->fails()){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt($data, $remember)){
            return redirect()->route('admin');
        }else{
            $validator->errors()->add('password','E-mail ou Senha incorretos! Por favor, tente novamente.');
            return redirect()->route('login')->withErrors($validator)->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
