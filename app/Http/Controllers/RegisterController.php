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
            'name' => '',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_admin' => 'required'
        ]);



        try {
            User::create($attributes);
            return redirect(route('viewUsers'))->with('message', ['text' => 'Корисникот е додаден', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewUsers'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }

    }
}
