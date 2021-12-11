<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = ['name','registration_number'];

    /**
     * The attributes that aren't mass assignable.
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function drivers()
    {
        return $this->belongsToMany(Driver::class, "driver_cars", "car_id", "driver_id")
            ->withPivot('note', 'km')
            ->withTimestamps();
    }
}
