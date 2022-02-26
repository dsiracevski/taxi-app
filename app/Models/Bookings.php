<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'next_date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
