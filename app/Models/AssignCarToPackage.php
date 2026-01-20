<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cars;

class AssignCarToPackage extends Model
{
    use HasFactory;

    protected $table = 'assign_car_to_package';
    protected $guarded = [];


    public function carData()
    {
        return $this->belongsTo(Cars::class, 'car_id', 'id');
    }
}
