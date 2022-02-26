<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Direction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view()
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $weeklyBookings = Bookings::where('is_active', 1)
            ->whereBetween('next_date', [
                now(),
                now()->addWeek()])
            ->orderBy('next_date')->get();

        return view('bookings.show', [
            'bookings' => $weeklyBookings
        ]);

    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewBooking(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        return view('bookings.booking', [
            'booking' => Bookings::find($request->booking_id)
        ]);

    }

    /**
     * ??
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refreshBooking($booking_id )
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }


        $booking = Bookings::where('id', $booking_id)->first();

        $currentDate = $booking->next_date;

//        dd($currentDate->dayOfWeek);

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
                    Bookings::where('id', $booking_id)->update(['is_active' => false]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
                }
                return redirect()->back()->with('message', ['text' => 'Букирањето е завршено', 'type' => 'success']);
            default:
                try {
                    Bookings::where('id', $booking_id)->update(['next_date' => $currentDate]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('message', ['text' => $e->getMessage(), 'type' => 'danger']);
                }
                return redirect()->back()->with('message', ['text' => 'Следната дата е додадена', 'type' => 'success']);
        }

    }

    /**
     * Update booking
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    /**
     * delete booking
     * @param Request $request
     */
    public function deleteBooking(Request $request)
    {
        dd($request);

    }


    /**
     * Store data in bookings table
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            redirect(route('login'));
        }

        $request->validate([
            'name' => 'required',
            'frequency' => 'required',
            'start_date' => 'required|after:now',
        ]);

        try {
            $user
                ->bookings()
                ->create([
                    'name' => $request->name,
                    'frequency' => $request->frequency,
                    'note' => isset($request->note) ? $request->note : '',
                    'start_date' => $request->start_date,
                    'next_date' => $request->start_date
                ]);
        } catch (\Exception $e) {
            return redirect(
                route('viewDirections'))
                ->with('message', [
                    'text' => $e->getMessage(),
                    'type' => 'danger'
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'Возилото е закажано',
            'type' => 'success'
        ]);
    }

    public function getBookings()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'error' => true,
            ], 401);
        }

        $upcomingBookings = Bookings::where('is_active', true)
            ->whereBetween('next_date', [
                now(),
                now()->addHours(3)])
            ->orderBy('next_date')
            ->get();

        return response()->json([
            'error' => false,
            'data' => $upcomingBookings
        ]);

    }
}
