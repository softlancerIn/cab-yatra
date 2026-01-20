<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cars;
use App\Models\CabAirportFair;

class CarCategory extends Model
{
    use HasFactory;

    protected $table = 'car_category';
    protected $guarded = [];

    /**
     * Get the user associated with the CarCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function car()
    {
        return $this->hasOne(Cars::class, 'category', 'id');
    }

    /**
     * Get the user that owns the CarCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function oneWayAirport()
    {
        return $this->belongsTo(CabAirportFair::class, 'id', 'car_category');
    }
}
