<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function view()
    {

        $user = auth()->user();
        if(!$user){
            redirect(route('login'));
        }


        return view('services.show', [
            'cars' => Car::has('drivers')->get(),
            'gas' => Services::find(2),
            'oil_change' => Services::find(1),
            'drivers' => Driver::has('cars')->get(),
            'user' => auth()->user()
        ]);
    }


    public function addFuel(Request $request)
    {

        $user = auth()->user();

        if(!$user){
            redirect(route('login'));
        }
        $car = Car::where('id', $request->car_id)->with('drivers')->first();

        try{
            $car->services()->attach($request->service_id, ['price'=>$request->price, 'km'=>$request->km, 'user_id' => $user->id, 'driver_id' => $request->driver_id]);
            return redirect(route('viewDirections'))->with('message', ['text'=>'Горивото е додадено','type'=>'success']);
        }
        catch (\Exception $e){
            return redirect(route('viewDirections'))->with('message', ['text'=>'Обидете се повторно!','type'=>'danger' ]);
        }


    }

    public function changeOil(Request $request)
    {

        $user = auth()->user();

        if(!auth()->user()->is_admin){
            redirect()->back()->with('message', ['text'=>'Немате дозвола!', 'type'=>'danger']);
        }

        $car = Car::where('id', $request->car_id)->with('drivers')->first();

        try{
            $car->services()->attach($request->service_id, ['price'=>$request->price, 'km'=>$request->km, 'user_id' => $user->id, 'driver_id' => $request->driver_id]);
            return redirect(route('viewDirections'))->with('message', ['text'=>'Промената на уље е додадена','type'=>'success']);
        }
        catch (\Exception $e){
            return redirect(route('viewDirections'))->with('message', ['text'=>'Обидете се повторно!','type'=>'danger' ]);
        }
    }
}