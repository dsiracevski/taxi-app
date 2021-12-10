<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function create()
    {

        return view('session.login');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($attributes)) {
            return redirect('/')->with('success', 'Welcome back!');
        }

        throw ValidationException::withMessages([
            'email' => 'Provided information can not be verified!'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
