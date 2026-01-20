<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('/public/uploads/packages/' . $value);
        } else {
            return asset('/public/uploads/cars/default.png');
        }
    }
}
