<?php

namespace App\View\Components;

use App\Models\Bookings;
use Illuminate\View\Component;


class Booking extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $upcomingBookings = Bookings::where('is_active', true)->whereBetween('next_date', [now(), now()->addHours(3)])->orderBy('next_date')->get();

        return view('components.booking',[
            'bookings' => $upcomingBookings
        ]);
    }
}
