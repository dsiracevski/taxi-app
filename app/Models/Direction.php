<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->timestamps = false;
            $model->created_at = now();
        });
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    public function driver()
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
