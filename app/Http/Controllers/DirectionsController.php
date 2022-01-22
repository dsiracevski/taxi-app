<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Companies;
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
        $allCars = Car::whereHas('drivers', function($q) {
            $q->where('driver_cars.on_work', 1);
        })->with('onWorkCars')->get();

        //        $allCars = Car::where('is_active', 1)->with('drivers')->get();
//        $allCars = Car::where('is_active', 1)->with('onWorkCars')->get();
//dd($allCars);

        /*        $drivers = Driver::whereHas('cars', function($q) {
                    $q->where('driver_cars.on_work', 0);
                })->with('cars')->get();*/
      /*  $drivers = Driver::with('onWorkCars')->whereHas('cars', function ($q) {
            $q->where('driver_cars.on_work', 1);
        })->get();*/

        $i = 0;
        /*$directions = [];
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

        }*/

       /* foreach ($allCars as $key => $car) {
            if (in_array($car->id, $takenCars)) {
                unset($allCars[$key]);
            }
        }*/

        return view('directions.show', [
            'locations' => Location::all(),
            'allDrivers' => $allDrivers,
            'user' => $user,
            'directions' => [],
            'cars' => $allCars,
            'companies' => Companies::all()
        ]);

    }

    public function adminView(Request $request)
    {

        if (!request('dateFrom')) {
            $startDate = Carbon::now()->startOfDay();
        } else
            $startDate = request()->dateFrom;


        if (!request('dateTo')) {
            $endDate = Carbon::now()->endOfDay();
        } else
            $endDate = request()->dateTo;

        $directions = Direction::with('driver.cars', 'users', 'locationFrom', 'locationTo', 'company')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return view('admin.directions', [
            'user' => auth()->user(),
            'companies' => Companies::all(),
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
        ]);

        try {
            $user->directions()->create($request->all());
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect()->back()->with('message', ['text' => 'Рутата е додадена', 'type' => 'success']);
        //return redirect(route('viewDirections'))->with('message', ['text' => 'Рутата е додадена', 'type' => 'success']);
    }

    public function storeScheduledDirections(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        try {
            $direction = new Direction();
            $direction['scheduled'] = 1;
            $direction['location_from_id'] = $request->location_from_id;
            $direction['location_to_id'] = $request->location_to_id;
            $direction['price'] = $request->price;
            $direction['company_id'] = $request->company_id;
            $direction->save();
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect()->back()->with('message', ['text' => 'Рутата е додадена', 'type' => 'success']);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }
        try {
            Direction::where('driver_id', $request->driver_id)
                ->where('id',$request->id)
                ->where('user_id', $user->id)
                ->update([
                    'location_from_id'=>$request->location_from_id,
                    'street_number_from'=>$request->street_number_from,
                    'location_to_id'=>$request->location_to_id,
                    'street_number_to'=>$request->street_number_to,
                    'price'=>$request->price,
                    'price_idle'=>$request->price_idle,
                    'price_order'=>$request->price_order,
                    'company_id'=>$request->company_id,
                    'return'=>isset($request->return) ? 1 : 0,
                    'note'=>$request->note,
                    ]);
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect()->back()->with('message', ['text' => 'Рутата е променета', 'type' => 'success']);
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
            Direction::where('id', $direction)
                ->where('user_id', auth()->user()->id)
                ->update($attributes);
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect(route('viewDirections'))->with('message', ['text' => 'Price is changed', 'type' => 'success']);;

    }

    public function getDirection($driverID)
    {
        $user = \auth()->user();
        $allDrivers = Driver::where('is_active', 1)->get();
        $directions = Direction::where('user_id', $user->id)
            ->where('driver_id', $driverID)
            ->whereDate('directions.created_at', '=', Carbon::today()->toDateString())
            ->join('locations as l', 'l.id', '=', 'directions.location_from_id')
            ->leftjoin('locations as lo', 'lo.id', '=', 'directions.location_to_id')
            ->select('directions.*', 'l.street_name as from_street_name', 'lo.street_name as to_street_name')
            ->orderBy('id', 'desc')
            ->get();
//        $driver = Driver::where('id', $driverID)->with('cars')->where('driver_cars.on_work', 1)->first();
        $driver = Driver::where('id',$driverID)->whereHas('cars', function($q) {
            $q->where('driver_cars.on_work', 1);
        })->with('onWorkCars')->first();
//        dd($driverID);
        return view('directions.driver', [
            'locations' => Location::all(),
            'user' => $user,
            'directions' => $directions,
            'companies' => Companies::all(),
            'allDrivers' => $allDrivers,
            'driverID' => $driverID,
            'driver' => $driver,

        ]);
    }

    public function getSingleDirection($id)
    {
        $user = \auth()->user();
        $directions = Direction::where('user_id', $user->id)->where('id',$id)->first();

        return response()->json([
            'data' => $directions,
        ]);
    }
}
