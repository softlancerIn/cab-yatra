<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarCategory;
use App\Models\Cars;

class CabAirportFair extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user associated with the CabAirportFair
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cabCategory()
    {
        return $this->hasOne(CarCategory::class, 'id', 'car_category');
    }

    public function car()
    {
        return $this->hasOneThrough(Cars::class, CarCategory::class, 'car_category', 'category', 'car_category', 'id');
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
