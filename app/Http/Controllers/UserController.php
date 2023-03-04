<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "first_name" => ['required'],
            "last_name" => ['required'],
            "email" => ['required', 'unique:users'],
            "password" => ['required']
        ], [
            'first_name.required' => "First obrigatorio",
            'last_name.required' => "Last obrigatorio",
            'email.required' => "Email obrigatorio",
            'email.unique' => "Email já registrado",
            'password.required' => "Password obrigatorio",
        ]);

        $user = $request->all();
        $user["password"] = bcrypt($request->password);

        $user = User::create($user);
        Auth::login($user);
        return redirect()->route('dashboard.index');
    }
}
