<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppBanner extends Model
{
    use HasFactory;

    protected $table = 'app_banner';
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('/public/uploads/app_banner/' . $value);
        } else {
            return asset('/public/uploads/cars/default.png');
        }
    }
}
