<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCarDetails extends Model
{
    use HasFactory;
    protected $table = 'driver_car_details';
    protected $guarded = [];

    protected $appends = ['car_image_url', 'insurence_image_url', 'car_rc_frontImage_url'];

    public function getInsurenceImageUrlAttribute()
    {
        return $this->insurence_image
            ? url('public/uploads/insurence_photo/' . $this->insurence_image)
            : '';
    }
    public function getCarRcFrontImageUrlAttribute()
    {
        return $this->car_rc_frontImage
            ? url('public/uploads/carRc_front_image/' . $this->car_rc_frontImage)
            : '';
    }

    public function getCarImageUrlAttribute()
    {
        return $this->car_image
            ? url('public/uploads/car_image/' . $this->car_image)
            : '';
    }
    // public function getCarRcrBackImageUrlAttribute()
    // {
    //     if ($this->car_rc_backImage) {
    //         return $this->car_rc_backImage
    //             ? url('public/uploads/carRc_back_image/' . $this->car_rc_backImage)
    //             : '';
    //     }
    //     return '';
    // }
}
