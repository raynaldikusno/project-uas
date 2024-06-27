<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'interest_rate',
        'duration',
        'start_time',
        'end_time',
        'transferred',
    ];

    // Definisi relasi jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}