<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function view()
    {

        return view('show.users', [
            'users' => User::all()
        ]);

    }

    public function show(User $user)
    {

        return view('show.user', [
            'user' => $user
        ]);

    }

    public function update(User $user)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

        $user->update($attributes);

        return redirect(route('viewUsers'));

    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('viewUsers'));
    }


}
