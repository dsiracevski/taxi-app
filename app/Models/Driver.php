<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class, "driver_cars", "driver_id", "car_id")
            //->withPivot('note', 'km','on_work')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directions()
    {
        return $this->hasMany(Direction::class, "driver_id", "id");
    }

    public function onWorkCars()
    {
        return $this->cars()->wherePivot('on_work', 1);
    }

}
