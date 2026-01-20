<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarCategory;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'invoice_bill';
    protected $guarded = [];

    /**
     * Get the user associated with the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(CarCategory::class, 'id', 'carCategoryId');
    }
}
