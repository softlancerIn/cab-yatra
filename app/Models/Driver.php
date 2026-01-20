<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\DriverCarDetails;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'driver';
    protected $guarded = [];

    protected $appends = ['driver_image_url', 'aadhar_frontImage_url', 'aadhar_backImage_url', 'dl_image_url'];

    public function getDriverImageUrlAttribute()
    {
        return $this->driver_image
            ? url('public/uploads/driver_photo/' . $this->driver_image)
            : '';
    }
    public function getAadharFrontImageUrlAttribute()
    {
        return $this->aadhar_frontImage
            ? url('public/uploads/aadhar_front_image/' . $this->aadhar_frontImage)
            : '';
    }
    public function getAadharBackImageUrlAttribute()
    {
        return $this->aadhar_backImage
            ? url('public/uploads/aadhar_back_image/' . $this->aadhar_backImage)
            : '';
    }
    public function getDlImageUrlAttribute()
    {
        return $this->dl_image
            ? url('public/uploads/dl_image/' . $this->dl_image)
            : '';
    }


    /**
     * Get the user associated with the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function DriverCarDetails()
    {
        return $this->hasOne(DriverCarDetails::class, 'driver_id', 'id');
    }
}
