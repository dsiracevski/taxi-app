<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function view()
    {

        return view('show.locations', [
            'locations' => Location::simplePaginate(10)
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
            'zone' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        Location::create($attributes);

        return redirect('locations/')->with('success', 'Driver added successfully!');

    }

    public function update(Location $location)
    {

        $attributes = request()->validate([
            'street_name' => 'required',
            'zone' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        $location->update($attributes);

        return redirect(route('viewLocations'));
    }

    public function destroy(Location $location)
    {

        $location->delete();

        return redirect(route('viewLocations'));
    }
}
