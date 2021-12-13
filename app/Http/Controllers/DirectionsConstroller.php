<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Driver;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DirectionsConstroller extends Controller
{
    public function show()
    {

        abort_if(!auth()->user()->is_admin, 403, 'No touchy, touchy... :)');



        return view('show.directions', [
            'locations' => Location::all(),
            'drivers' => Driver::all(),
            'directions' => auth()->user()->directions
        ]);
    }

    public function store(Request $request, User $user)
    {

        $attributes = request()->validate([
            'driver_id' => 'required',
            'location_from_id' => 'required',
            'location_to_id' => 'required',
            'price' => 'required',
            'scheduled' => ''
        ]);

//        dd($attributes);

        $user->directions()->create($attributes);

        return redirect('directions/')->with('success', 'Driver added successfully!');

    }

}
