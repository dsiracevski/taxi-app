<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
{

    public function view()
    {

        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $weeklyBookings = Bookings::whereBetween('next_date', [now(), now()->addWeek()])->orderBy('next_date')->get();



        return view('bookings.show', [
            'bookings' => $weeklyBookings
        ]);

    }

    public function viewBooking(Request $request)
    {

//dd($request->booking_id);
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }


        return view('bookings.booking', [
            'booking' => Bookings::find($request->booking_id)
        ]);

    }


    public function store(Request $request)
    {

//        dd($request->all());
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $request->validate([
            'name' => 'required',
            'frequency' => 'required',
            'start_date' => 'required|after:now',
            'note' => ''
        ]);


        try {
            $user->bookings()->create(['name' => $request->name, 'frequency' => $request->frequency,
                'note' => $request->note, 'start_date' => $request->start_date, 'next_date' => $request->start_date]);
        } catch (\Exception $e) {
            return redirect(route('viewDirections'))->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
        }
        return redirect()->back()->with('message', ['text' => 'Возилото е закажано', 'type' => 'success']);
    }
}
