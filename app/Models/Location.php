<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function directionFrom()
    {
        return $this->hasMany(Direction::class, "location_from_id");
    }

    public function directionTo()
    {
        return $this->hasMany(Direction::class, "location_to_id");
    }
}
