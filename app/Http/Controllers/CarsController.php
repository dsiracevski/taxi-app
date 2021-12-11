<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    public function view()
    {

        return view('show.cars', [
            'cars' => Car::all()
        ]);
    }

    public function show(Car $car)
    {
        return view('show.car', [
            'car' => $car
        ]);
    }


    public function create(Request $request)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'registration_number' => 'required'
        ]);

        Car::create($attributes);

        return redirect('cars/')->with('success', 'Car added successfully!');

    }

    public function update(Car $car)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'registration_number' => 'required'
        ]);

        $car->update($attributes);

        return redirect(route('viewCars'));
    }

    public function destroy(Car $car)
    {

        $car->delete();

        return redirect(route('viewCars'));
    }

    public function assignDriver(Request $request, Car $car)
    {
        $car->drivers()->attach($request->driver()->id);
    }
}
