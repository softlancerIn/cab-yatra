<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CarCategory;
use App\Models\Cars;
use App\Models\Driver;

class cabBooking extends Model
{
    use HasFactory;

    protected $table = 'cabBooking';
    protected $guarded = [];

    protected $appends = [
        'type_label',
        'sub_type_label',
        'is_airport_label',
    ];

    public function getTypeLabelAttribute()
    {
        $statusMapping = [
            0 => 'Local',
            1 => 'Outstation',
        ];

        return $statusMapping[$this->type] ?? 'Unknown';
    }

    public function getSubTypeLabelAttribute()
    {
        $statusMapping = [
            0 => 'Round Trip',
            1 => 'One way',
            2 => 'Airport',
            3 => 'Local Trip'
        ];

        return $statusMapping[$this->subType] ?? 'Unknown';
    }

    public function getIsAirportLabelAttribute()
    {
        $statusMapping = [
            0 => 'To Airport',
            1 => 'From Airport',
            2 => 'Not for Airport',
        ];

        return $statusMapping[$this->is_airpotToFrom] ?? 'Unknown';
    }


    /**
     * Get the user that owns the cabBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class, 'carCategory_id', 'id')->select(['id', 'name', 'extra_fair_perKm', 'extra_fair_perHour', 'fuel_charge', 'driver_charge', 'night_charge', 'toll', 'tax', 'parking']);
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'carCategory_id', 'category')->select(['id', 'name', 'category']);
    }

    public function timeSchadule_data()
    {
        return $this->belongsTo(Time::class, 'timeSchadule_id', 'id')
            ->select(['id', 'time']);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id')->select(['id', 'name', 'phone']);
    }
}
