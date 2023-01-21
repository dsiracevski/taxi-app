<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServicesController extends Controller
{


    public function view()
    {

        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }


        return view('services.show', [
            'cars' => Car::has('drivers')->get(),
            'gas' => Services::find(2),
            'services' => Services::all(),
            'drivers' => Driver::has('cars')->get(),
            'user' => auth()->user()
        ]);
    }

    public function show(Services $services)
    {
        return view('services.view', [
            'service' => $services->cars()->first()
        ]);
    }


    public function addService(Request $request)
    {

        $user = auth()->user();

        if (!$user) {
            redirect(route('login'));
        }
        $car = Car::where('id', $request->car_id)->with('drivers')->first();

        try {
            $car->services()->attach($request->service_id, ['price' => $request->price, 'amount' => $request->amount, 'user_id' => $user->id]);
            return redirect(route('viewServices'))->with('message', ['text' => 'Горивото е додадено', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewServices'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }


    }

    public function updateService()
    {
        $user = auth()->user();

        if (!$user) {
            redirect(route('login'));
        }
        $car = Car::where('id', $request->car_id)->with('drivers')->first();

        try {
            $car->services()->update($request->service_id, ['price' => $request->price, 'km' => $request->km, 'user_id' => $user->id]);
            return redirect(route('viewServices'))->with('message', ['text' => 'Горивото е додадено', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewServices'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }
    }

    public function addFuel(Request $request)
    {

        $user = auth()->user();

        if (!$user) {
            redirect(route('login'));
        }
        $car = Car::where('id', $request->car_id)->with('drivers')->first();

        try {
            $car->services()->attach($request->service_id, ['price' => $request->price, 'km' => $request->km, 'user_id' => $user->id]);
            return redirect(route('viewServices'))->with('message', ['text' => 'Горивото е додадено', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('viewServices'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }
}
