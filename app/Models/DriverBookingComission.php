<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FooterLinkCategory;

class DriverBookingComission extends Model
{
    use HasFactory;

    protected $table = 'driverBooking_comission';
    protected $guarded = [];
}
