<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Direction;
use App\Models\Driver;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function view()
    {

        return view('show.users', [
            'users' => User::all()
        ]);

    }

    public function show(User $user)
    {

        return view('show.user', [
            'user' => $user
        ]);

    }

    public function update(Request $request)
    {

        $attributes = request()->validate([
            'name' => '',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'is_admin' => 'required'
        ]);

        $user = User::where('id', $request->id)->first();

        try {
            $user->update($attributes);
            return redirect(route('viewUsers'))->with('message', ['text' => 'Корисникот е едитиран', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewUsers'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }

    }


    public function destroy(User $user)
    {

        try {
            $user->delete();

            return redirect(route('viewUsers'))->with('message', ['text' => 'Корисникот е избришан', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewUsers'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }
    }

    public function endShift()
    {
        $user = \auth()->user();
        $today = Carbon::today()->toDateString();

        $driverInvoicesWithInvoice = DB::table('drivers')
            ->leftJoin('directions', 'directions.driver_id', '=', 'drivers.id')
            ->leftJoin('companies', 'directions.company_id', '=', 'companies.id')
//            ->leftJoin('car_services', function ($query) use ($today) {
//                $query->on('car_services.driver_id', '=', 'drivers.id')->whereDate('car_services.created_at', $today);
//            })
            ->select('drivers.*', 'directions.*', 'companies.name as company_name',
                DB::raw('SUM(directions.price_order) as priceOrder'),
//                DB::raw('SUM(car_services.price) as priceService'),
                DB::raw('SUM(directions.price) as priceBase'),
                DB::raw('SUM(directions.price_idle) as priceIdle'))
            ->whereDate('directions.created_at', '=', Carbon::today()->toDateString())
            ->where('directions.user_id', $user->id)
            ->where('company_id', '<>', null)
            ->groupBy('companies.id')
            ->get();

        $driverInvoicesWithNoInvoice = DB::table('drivers')
            ->leftJoin('directions', 'directions.driver_id', '=', 'drivers.id')
//            ->leftJoin('car_services', function ($query) use ($today) {
//                $query->on('car_services.driver_id', '=', 'drivers.id')->whereDate('car_services.created_at', $today);
//            })
            ->select('drivers.*', 'directions.*',
//                DB::raw('SUM(car_services.price) as priceService'),
                DB::raw('SUM(directions.price_order) as priceOrder'),
                DB::raw('SUM(directions.price) as priceBase'),
                DB::raw('SUM(directions.price_idle) as priceIdle'))
            ->whereDate('directions.created_at', '=', Carbon::today()->toDateString())
            ->where('directions.user_id', $user->id)
            ->where('company_id', '=', null)
            ->groupBy('drivers.id')
            ->get();

        $drivers = Driver::has('directions')->with('tDirections.company', 'cars')->get();


        $invoices = Direction::with('driver.cars', 'company')
            ->whereDate('created_at', today())
            ->whereNotNull('company_id')
            ->get();


//        $d = DB::statement("SELECT * from drivers WHERE is_active = 1 inner_join ")
//        dd($d);

        return view('users.shift', [
            'user' => auth()->user(),
            'drivers' => $drivers,
            'withNoInvoice' => $driverInvoicesWithNoInvoice,
            'withInvoice' => $driverInvoicesWithInvoice
        ]);
    }

    public function endShiftDriver()
    {
        $drivers = Driver::where('is_active',1)->whereHas('cars', function($q) {
            $q->where('driver_cars.on_work', 1);
        })->with('onWorkCars')->get();
        $allAvilibledrivers = Driver::where('is_active',1)->whereHas('cars', function($q) {
            $q->where('driver_cars.on_work', 0);
        })->with('onWorkCars')->get();

        $allCars = Car::where('is_active', 1)->get();
        $busyCars = Car::where('is_active', 1)->whereHas('drivers', function($q) {
            $q->where('driver_cars.on_work', 1);
            })->with('drivers')->pluck('id')->toArray();
        foreach ($allCars as $key => $car){
            if(in_array($car->id, $busyCars)){
                unset($allCars[$key]);
            }
        }
        return view('users.endShiftDriver', [
            'drivers' => $drivers,
            'allAvailableDrivers' => $allAvilibledrivers,
            'cars' => $allCars
        ]);
    }
    public function endShiftForDriver(Request $request)
    {
        //need validation
        $user = \auth()->user();
        $user_id = $user->id;
        $driver_id = $request->driver_id;
        $id = $request->id;
        $km = $request->km;
        $result =  DB::statement("UPDATE `driver_cars` SET `on_work` = 0,  `km_end` = {$km} WHERE `id` = {$id} AND `driver_id` = {$driver_id} ");
        return redirect()->back();
    }


}
