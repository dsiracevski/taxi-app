<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'registration_number' => 'required',
            'is_active'
        ]);

        $car->update($attributes);

        return redirect(route('viewCars'));
    }

    public function destroy(Car $car)
    {

        $car->delete();

        return redirect(route('viewCars'));
    }


    public function assignView()
    {
        return view('cars.assign', [
            'drivers' => Driver::all()->where('is_active', 1),
            'user' => auth()->user(),
            'cars' => Car::all()->where('is_active', 1)
        ]);
    }

    public function assignDriver(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            redirect(route('login'));
        }
        $car = Car::where('id', $request->car)->with('drivers')->first();

//        DB::table('driver_cars')
//            ->where('car_id', $request->car)  // find your user by their email
//            ->update(array('on_work' => 0));  // update the record in the DB.
//        DB::table('driver_cars')
//            ->where('driver_id', $request->driver_id)  // find your user by their email
//            ->update(array('on_work' => 0));  // update the record in the DB.

        try{
            $car->drivers()->attach($request->driver_id, ['note'=>$request->note, 'km'=>$request->km, 'on_work'=>1, 'user_id' => $user->id, 'shift' => $request->shift]);
            return redirect(route('viewDirections'))->with('message', ['text'=>'Driver is assign to car','type'=>'success']);
        }
        catch (\Exception $e){
            return redirect(route('viewDirections'))->with('message', ['text'=>'Error occured','type'=>'danger']);;
        }

    }
}
