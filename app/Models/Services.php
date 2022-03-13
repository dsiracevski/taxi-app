<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_services', 'service_id', 'car_id')
            ->withPivot('created_at')
            ->withTimestamps();
    }
}
