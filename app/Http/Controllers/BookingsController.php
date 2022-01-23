<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingsController extends Controller
{


    public function store(Request $request)
    {

//        dd($request->all());
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $request->validate([
            'name' => 'required',
            'frequency' => 'required',
            'start_date' => 'required',
            'note' => ''
        ]);

        try {
            $user->bookings()->create($request->all());
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect()->back()->with('message', ['text' => 'Возилото е закажано', 'type' => 'success']);
    }
}
