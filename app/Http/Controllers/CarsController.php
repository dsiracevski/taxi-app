<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Carbon\Carbon;
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


    public function create()
    {


        $attributes = request()->validate([
            'name' => 'required',
            'registration_number' => 'required',
            'gas_type' => 'required',
            'is_active' => 'required'
        ]);


        try {
            Car::create($attributes);
            return redirect(route('viewCars'))->with('message', ['text' => 'Возилото е додадено', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewCars'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }

    }

    public function update(Car $car)
    {


        $attributes = request()->validate([
            'name' => 'required',
            'registration_number' => 'required',
            'gas_type' => 'required',
            'is_active' => ''
        ]);


        try {
            $car->update($attributes);
            return redirect(route('viewCars'))->with('message', ['text' => 'Возилото е едитирано', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewCars'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }
    }

    public function destroy(Car $car)
    {


        try {
            $car->delete();
            return redirect(route('viewCars'))->with('message', ['text' => 'Возилото е избришано', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewCars'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }

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

//        dd($request->all());

        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }
        $car = Car::where('id', $request->car)->with('drivers')->first();

        $driver = Driver::find(request()->driver_id);

        try {
            $car->drivers()->attach($request->driver_id, [
                'note' => $request->note,
                'km' => $request->km,
                'on_work' => 1, 'user_id' => $user->id,
                'shift' => $request->shift,
                'shift_start' => $request->shift_start . ":00"]);

            $driver->update(['is_active' => 1]);
            return redirect(route('endShiftDriver'))->with('message', ['text' => 'Возачот е додаден', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('endShiftDriver'))->with('message', ['text' => 'Обидете се повторно', 'type' => 'danger']);
        }

    }

    public function showServices(Car $car)
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        if (!request('dateFrom')) {
            $startDate = Carbon::today()->startOfDay();
        } else
            $startDate = request()->dateFrom;


        if (!request('dateTo')) {
            $endDate = Carbon::today()->endOfDay();
        } else
            $endDate = request()->dateTo;


        return view('cars.services', [
            'services' => $car->qServices($startDate, $endDate)->get(),
            'car' => $car
        ]);
    }
}
