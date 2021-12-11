<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    public function view()
    {

        return view('add.cars', [
            'cars' => Car::all()
        ]);
    }

    public function show(Car $car)
    {
        return view('show.car', [
            'car' => request($car)
        ]);
    }


    public function create(Request $request)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'registration_number' => 'required'
        ]);

        Car::create($attributes);

        return redirect('/')->with('success', 'Car added successfully!');

    }

    public function update(Car $car)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'registration_number' => 'required'
        ]);

        $car->update($attributes);

        return redirect(route('view'));
    }

    public function destroy(Car $car)
    {

        $car->delete();

        return redirect(route('viewCar'));
    }

    public function assignDriver(Request $request, Car $car)
    {
        $car->drivers()->attach($request->driver()->id);
    }
}
