<?php

namespace App\View\Components;

use App\Models\Car;
use Illuminate\View\Component;

class Menu extends Component
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
        $allCars = Car::whereHas('drivers', function($q) {
            $q->where('driver_cars.on_work', 1);
        })->with('onWorkCars')->get();
        return view('components.menu', ['allCars' => $allCars]);
    }
}
