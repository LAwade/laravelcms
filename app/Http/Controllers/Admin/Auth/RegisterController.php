<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:4',
            'email' => 'required|string|email|max:150|min:10|unique:users',
            'password' => 'required|string|max:20|min:5|confirmed',
            'password_confirmation' => 'required|string|max:20|min:5'
        ]);

        if($validator->fails()){
            return redirect()->route('register')->withErrors($validator)->withInput();
        }
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            //$user->email_verify_at = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->remember_token = password_hash(time(), PASSWORD_DEFAULT);
            if ($user->save()) {
                Auth::login($user);
                return redirect()->route('admin');
            } else {
                return redirect()->route('register')->withErrors($validator)->withInput();
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error in create user.' . $e->getMessage()], 500);
        }

        return view('admin.register');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
