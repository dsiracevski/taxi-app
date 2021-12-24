<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(Request $request)
    {


        $attributes = request()->validate([
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

            User::create($attributes);



        return redirect(route('adminView'))->with('success', 'User created successfully!');

    }
}
