<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Direction;
use App\Models\Driver;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class DirectionsController extends Controller
{
    public function show()
    {
        $user = \auth()->user();
        if(!$user){
            redirect(route('login'));
        }
        $allDrivers = Driver::where('is_active', 1)->get();
        $allCars =  Car::where('is_active', 1)->get();
/*        $drivers = Driver::whereHas('cars', function($q) {
            $q->where('driver_cars.on_work', 0);
        })->with('cars')->get();*/
        $drivers = Driver::with('onWorkCars')->whereHas('cars', function($q) {
            $q->where('driver_cars.on_work', 1);
         })->get();

        $i = 0;
        $directions = [];
        $takenCars = [];
        foreach($drivers as $driver){
            $takenCars[] = $driver->onWorkCars[0]->id;
            $directions[$driver->id]['driver_id'] = $driver->id;
            $directions[$driver->id]['driver_first_name'] = $driver->first_name;
            $directions[$driver->id]['driver_last_name'] = $driver->last_name;
            $directions[$driver->id]['car_name'] = $driver->onWorkCars[0]->name;
            $directions[$driver->id]['car_id'] = $driver->onWorkCars[0]->id;
            $directions[$driver->id]['directions'] = Direction::where('user_id',$user->id)
                ->where('driver_id',$driver->id)
                ->whereDate('directions.created_at', '=', Carbon::today()->toDateString())
                ->join('locations as l', 'l.id', '=', 'directions.location_from_id')
                ->join('locations as lo', 'lo.id', '=', 'directions.location_to_id')
                ->select('directions.*', 'l.street_name as from_street_name', 'lo.street_name as to_street_name')
                ->get();

        }

        foreach ($allCars as $key => $car){
            if(in_array($car->id, $takenCars)){
                unset($allCars[$key]);
            }
        }

        return view('directions.show', [
            'locations' => Location::all(),
            'allDrivers' => $allDrivers,
            'user' => $user,
            'directions' => $directions,
            'cars' => $allCars
        ]);
    }

    public function store(Request $request)
    {
        $user = \auth()->user();
        if(!$user){
            redirect(route('login'));
        }
        $attributes = request()->validate([
            'driver_id' => 'required',
            'location_from_id' => 'required',
            'location_to_id' => 'required',
            'price' => 'required',
            'scheduled' => ''
        ]);

        try {
            $user->directions()->create($attributes);
        }
        catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text'=>'Error occurred!','type'=>'danger']);
        }
        return redirect(route('viewDirections'))->with('message', ['text'=>'Route is added','type'=>'success']);
    }
}