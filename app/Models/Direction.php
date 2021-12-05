<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    public function drivers()
    {
        return $this->belongsTo(Driver::class, "driver_id");
    }

    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function locationFrom()
    {
        return $this->belongsTo(Location::class, "location_from_id");
    }

    public function locationTo()
    {
        return $this->belongsTo(Location::class, "location_to_id");
    }
}
