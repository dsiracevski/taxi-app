<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

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
