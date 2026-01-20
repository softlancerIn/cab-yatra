<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Time;

class TimeSchadule extends Model
{
    use HasFactory;

    protected $table = 'time_schadule';
    protected $guarded = [];


    /**
     * Get the user associated with the TimeSchadule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function timeData()
    {
        return $this->hasOne(Time::class, 'id', 'time_id');
    }

    public function car_category(): mixed
    {
        return $this->hasOne(CarCategory::class, 'id', 'car_category');
    }

    public function carCategory(): mixed
    {
        return $this->hasOne(CarCategory::class, 'id', 'car_category');
    }
}
