<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function directions()
    {
        return $this->hasMany(Direction::class, 'company_id', 'id');
    }
}
