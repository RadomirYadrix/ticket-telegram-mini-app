<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'transport_id',
        'status',
        'payment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
