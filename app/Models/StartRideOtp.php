<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartRideOtp extends Model
{
    use HasFactory;

    protected $table = 'start_ride_otp';
    protected $guarded = [];
}
