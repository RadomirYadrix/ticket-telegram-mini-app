<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'type',
        'name',
        'route',
        'departure_at',
        'arrival_at',
        'from_location',
        'to_location',
        'price',
    ];

    protected $casts = [
        'departure_at' => 'datetime',
        'arrival_at' => 'datetime',
    ];
}
