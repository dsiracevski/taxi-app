<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function view()
    {

        return view('add.locations', [
            'locations' => Location::all()
        ]);
    }

    public function show(Location $location)
    {
        return view('show.location', [
            'location' => $location
        ]);
    }


    public function create(Request $request)
    {

        $attributes = request()->validate([
            'street_name' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        Location::create($attributes);

        return redirect('/')->with('success', 'Driver added successfully!');

    }

    public function update(Location $location)
    {

        $attributes = request()->validate([
            'street_name' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        $location->update($attributes);

        return redirect(route('view'));
    }

    public function destroy(Location $location)
    {

        $location->delete();

        return redirect(route('view'));
    }
}
