<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function create()
    {
        if (isset(auth()->user()->is_admin) && !auth()->user()->is_admin) {
            return redirect(route('viewDirections'));
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {

//        dd($request);

        $attributes = $request->validate([
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required'
            ]
        ]);


        if (Auth::attempt($attributes)) {
            if (!auth()->user()->is_admin) {
                return redirect(route('viewDirections'));
            }

            return redirect(route('adminView'));
        }

        throw ValidationException::withMessages([
            'error' => 'Provided information can not be verified!'
        ]);

    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
