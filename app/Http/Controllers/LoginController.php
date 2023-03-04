<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.form');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return redirect()->back()->with('erro', 'Email ou senha invalidos');
    }

    public function create()
    {
        return view('login.create');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
