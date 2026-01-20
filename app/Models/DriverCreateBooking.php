<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCreateBooking extends Model
{
    use HasFactory;

    protected $table = 'driver_create_bookings';
    protected $guarded = [];

    /**
     * Get the carCategory that owns the DriverCreateBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class, 'car_category_id', 'id')->select(['id', 'name', 'extra_fair_perKm', 'extra_fair_perHour', 'fuel_charge', 'driver_charge', 'night_charge', 'toll', 'tax', 'parking']);
    }
    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_category_id', 'category')->select(['id', 'name', 'category']);
    }
}
