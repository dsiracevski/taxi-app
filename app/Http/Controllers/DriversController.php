<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriversController extends Controller
{

    public function view()
    {

        return view('show.drivers', [
            'drivers' => Driver::all()
        ]);
    }

    public function show(Driver $driver)
    {
        return view('show.driver', [
            'driver' => $driver
        ]);
    }


    public function viewShifts()
    {

        if (!request('dateFrom')) {
            $startDate = Carbon::now()->startOfDay();
        } else
            $startDate = request()->dateFrom;


        if (!request('dateTo')) {
            $endDate = Carbon::now()->endOfDay();
        } else
            $endDate = request()->dateTo;

        $allShifts = DB::table('drivers')
            ->rightJoin('driver_cars', 'drivers.id', '=', 'driver_cars.driver_id')
            ->leftJoin('cars', 'cars.id', '=', 'driver_cars.car_id')
            ->select('drivers.first_name', 'drivers.last_name', 'drivers.is_active', 'driver_cars.*', 'cars.name as car_name')
            ->where('on_work', 0)
            ->whereBetween('driver_cars.created_at', [$startDate, $endDate])
            ->get();

        return view('admin.shifts', [
            'shifts' => $allShifts
        ]);
    }

    public function create(Request $request)
    {

        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);


        try {
            Driver::create($attributes);
            return redirect(route('viewDrivers'))->with('message', ['text' => 'Возачот е додаден', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewDrivers'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }

    }

    public function update(Request $request)
    {


        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'is_active' => 'required'
        ]);

        $driver = Driver::where('id', $request->driver);

        try {
            $driver->update($attributes);
            return redirect(route('viewDrivers'))->with('message', ['text' => 'Возачот е едитиран', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewDrivers'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }
    }

    public function destroy(Driver $driver)
    {

        try {
            $driver->delete();
            return redirect(route('viewDrivers'))->with('message', ['text' => 'Возачот е избришан', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewDrivers'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }
    }
}
