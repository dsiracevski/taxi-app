<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = ['name', 'registration_number', 'is_active', 'gas_type'];

    /**
     * The attributes that aren't mass assignable.
     * @var string[]
     */
    protected $guarded = ['id'];


    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class, "driver_cars", "car_id", "driver_id")
            ->withPivot('on_work', 'km', 'note', 'shift', 'id')->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(
            Services::class,
            'car_services',
            'car_id',
            'service_id'
        )->withTimestamps();
    }

    public function qServices($startDate, $endDate)
    {
        return $this->services()
            ->withPivot('price', 'amount', 'km')
            ->whereBetween('car_services.created_at', [$startDate, $endDate])
            ->withTimestamps();
    }

    public function onWorkCars()
    {
        return $this->drivers()->wherePivot('on_work', true);
    }

    public function directions()
    {
        return $this->hasMany(Direction::class);
    }
}
