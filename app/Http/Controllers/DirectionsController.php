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
        if (!$user) {
            redirect(route('login'));
        }
        $allDrivers = Driver::where('is_active', 1)->get();
        $allCars = Car::where('is_active', 1)->get();
        /*        $drivers = Driver::whereHas('cars', function($q) {
                    $q->where('driver_cars.on_work', 0);
                })->with('cars')->get();*/
        $drivers = Driver::with('onWorkCars')->whereHas('cars', function ($q) {
            $q->where('driver_cars.on_work', 1);
        })->get();

        $i = 0;
        $directions = [];
        $takenCars = [];
        foreach ($drivers as $driver) {
            $takenCars[] = $driver->onWorkCars[0]->id;
            $directions[$driver->id]['driver_id'] = $driver->id;
            $directions[$driver->id]['driver_first_name'] = $driver->first_name;
            $directions[$driver->id]['driver_last_name'] = $driver->last_name;
            $directions[$driver->id]['car_name'] = $driver->onWorkCars[0]->name;
            $directions[$driver->id]['car_id'] = $driver->onWorkCars[0]->id;
            $directions[$driver->id]['directions'] = Direction::where('user_id', $user->id)
                ->where('driver_id', $driver->id)
                ->whereDate('directions.created_at', '=', Carbon::today()->toDateString())
                ->join('locations as l', 'l.id', '=', 'directions.location_from_id')
                ->join('locations as lo', 'lo.id', '=', 'directions.location_to_id')
                ->select('directions.*', 'l.street_name as from_street_name', 'lo.street_name as to_street_name')
                ->get();

        }

        foreach ($allCars as $key => $car) {
            if (in_array($car->id, $takenCars)) {
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

    public function adminView(Request $request)
    {

        if (!request('dateFrom')) {
            $startDate = Carbon::today()->startOfDay()->format("Y-m-d H:i:s");
        } else
            $startDate = request()->dateFrom;


        if (!request('dateTo')) {
            $endDate = Carbon::now()->format("Y-m-d H:i:s");
        } else
            $endDate = request()->dateTo;

//dd($endDate);

        $directions = DB::table('directions')
            ->leftJoin('drivers', 'drivers.id', '=', 'directions.driver_id')
            ->leftJoin('users as u', 'u.id', '=', 'directions.user_id')
            ->join('locations as l', 'l.id', '=', 'directions.location_from_id')
            ->join('locations as lo', 'lo.id', '=', 'directions.location_to_id')
//            ->join('cars', 'cars.id', )
            ->select('directions.*', 'drivers.*', 'u.first_name as userFirst', 'u.last_name as userLast', 'l.street_name as from_street_name', 'lo.street_name as to_street_name')
            ->whereBetween('directions.created_at', [$startDate, $endDate])
            ->orderBy('directions.driver_id')
            ->get();

        return view('admin.directions', [
            'user' => auth()->user(),
            'directions' => $directions
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }
       $request->validate([
            'driver_id' => 'required',
            'location_from_id' => 'required',
            'location_to_id' => 'required',
            'price' => 'required',
        ]);

        try {
            $user->directions()->create($request->all());
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect(route('viewDirections'))->with('message', ['text' => 'Рутата е додадена', 'type' => 'success']);
    }



    public function updateIdle(Request $request)
    {
        $attributes = request()->validate([
            'driver_id' => 'required',
            'location_from_id' => 'required',
            'location_to_id' => 'required',
            'price' => 'required',
            'scheduled' => '',
            'street_number_to' => '',
            'street_number_from ' => '',
            'price_idle' => 'required',
            'price_order' => '',
            'invoice' => ''
        ]);

        $direction = $request->direction_id;

        try {
            Direction::where('id', $direction)->where('user_id', auth()->user()->id)->update($attributes);
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect(route('viewDirections'))->with('message', ['text' => 'Price is changed', 'type' => 'success']);;

    }
}
