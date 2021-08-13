<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', [
            'users' => $users,
            'loggedid' => Auth::id() 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:100'],
            'email' => ['required', 'string', 'email', 'min:10', 'max:150', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'max:20', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        if ($user->save()) {
            Session::flash('success', 'Usuário foi criado!');
        } else {
            Session::flash('error', 'Não foi possível criar um novo registro!');
        }
        return view('admin.users.create');
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
        $user = User::find($id);
        if ($user) {
            return view('admin.users.edit', ['user' => $user]);
        }
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
        $user = User::find($id);
        if ($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'min:5', 'max:100'],
                'email' => ['required', 'string', 'email', 'min:10', 'max:150', 'unique:users,email,' . $id],
                'password' => ['nullable', 'required_with:password_confirmation', 'string', 'min:5', 'max:20', 'confirmed']
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
            }

            $user->name = $data['name'];
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            if ($user->save()) {
                Session::flash('success', 'Usuário foi editado!');
                return redirect()->route('users.edit', $id);
            } else {
                return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (Auth::id() != $id && $user && $user->delete()) {
            Session::flash('success', 'O registro foi excluido!');
            return redirect()->route('users.index');
        }

        Session::flash('error', 'Não é possível excluir este registro!');
        return redirect()->route('users.index');
    }
}
