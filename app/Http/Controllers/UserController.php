<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
