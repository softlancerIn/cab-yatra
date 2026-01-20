<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarCategory;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('/public/uploads/cars/' . $value);
        } else {
            return asset('/public/uploads/cars/default.png');
        }
    }

    /**
     * Get the user that owns the Cars
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carCat()
    {
        return $this->belongsTo(CarCategory::class, 'category', 'id');
    }
}
