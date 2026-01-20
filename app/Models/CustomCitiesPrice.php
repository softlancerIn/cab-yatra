<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarCategory;

class CustomCitiesPrice extends Model
{
    use HasFactory;

    protected $table = 'custom_cities_prices';
    protected $guarded = [];


    /**
     * Get the car_category that owns the CustomCitiesPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class, 'car_category', 'id');
    }
}
