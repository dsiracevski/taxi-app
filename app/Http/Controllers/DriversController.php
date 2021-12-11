<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function view()
    {

        return view('add.drivers', [
            'drivers' => Driver::all()
        ]);
    }

    public function show(Driver $driver)
    {
        return view('show.driver', [
            'driver' => $driver
        ]);
    }

    public function create(Request $request)
    {


        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        Driver::create($attributes);

        return redirect('/')->with('success', 'Driver added successfully!');

    }

    public function update(Driver $driver)
    {

        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $driver->update($attributes);

        return redirect(route('view'));
    }

    public function destroy(Driver $driver)
    {

        $driver->delete();

        return redirect(route('view'));
    }
}
