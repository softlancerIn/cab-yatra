<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarCategory;
use App\Models\CustomCitiesPrice;

class CustomCitiesCarPrice extends Model
{
    use HasFactory;

    protected $table = 'custom_cities_car_price';
    protected $guarded = [];

    /**
     * Get the user associated with the CarCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class, 'car_categoryId', 'id');
    }

    /**
     * Get the customCities that owns the CustomCitiesCarPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customCities()
    {
        return $this->belongsTo(CustomCitiesPrice::class, 'custom_citiesId', 'id');
    }
}
