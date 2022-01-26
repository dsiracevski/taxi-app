<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Direction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller
{

    public function view()
    {

        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $weeklyBookings = Bookings::where('is_active', 1)->whereBetween('next_date', [now(), now()->addWeek()])->orderBy('next_date')->get();


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

    public function refreshBooking(Request $request)
    {

        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $booking = Bookings::where('id', $request->booking)->first();

        $currentDate = $booking->next_date;


        switch ($booking->frequency) {
            case 'daily':
                $currentDate = Carbon::parse($currentDate)->addDay();
                break;
            case 'monthly':
                $currentDate = Carbon::parse($currentDate)->addMonth();
                break;
        }

        switch ($booking->frequency) {
            case 'once':
                try {
                    Bookings::where('id', $request->booking)->update(['is_active' => false]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
                }
                return redirect()->back()->with('message', ['text' => 'Јеееееееееј', 'type' => 'success']);
            default:
                try {
                    Bookings::where('id', $request->booking)->update(['next_date' => $currentDate]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
                }
                return redirect()->back()->with('message', ['text' => 'Јеееееееееј', 'type' => 'success']);
        }

    }

    public function updateBooking(Request $request)
    {

        $attributes = request()->validate([
            'name' => '',
            'frequency' => '',
            'is_active' => '',
            'note' => '',
            'next_date' => ''
        ]);


        $booking = Bookings::where('id', $request->id)->first();

        $booking->update($attributes);

        return view('bookings.booking', [
            'booking' => Bookings::find($request->booking_id)
        ]);

    }

    public function deleteBooking(Request $request)
    {
        dd($request);

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
