<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\City;

class TourPackages extends Model
{
    use HasFactory;

    protected $table = 'tour_packages';
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('/public/uploads/tour_package/' . $value);
        } else {
            return asset('/public/uploads/cars/default.png');
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
