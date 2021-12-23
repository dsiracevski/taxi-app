<?php

namespace App\Http\Controllers;

use App\Models\Driver;
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

    public function update(User $user)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'is_admin' => 'required'
        ]);

        $user->update($attributes);

        return redirect(route('viewUsers'));

    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('viewUsers'));
    }

    public function endShift()
    {
        $driverInvoices = DB::table('drivers')
            ->leftJoin('directions', 'directions.driver_id', '=', 'drivers.id')
            ->select('drivers.*', DB::raw('SUM(directions.price_order) as priceOrder'), DB::raw('SUM(directions.price) as priceBase'), DB::raw('SUM(directions.price_idle) as priceIdle'),)
            ->whereDate('directions.created_at', '=', Carbon::today()->toDateString())
            ->where('invoice', '=', false)
            ->groupBy('drivers.id')
            ->get();


        return view('users.shift', [
            'user' => auth()->user(),
            'driverInvoices' => $driverInvoices
        ]);
    }


}
