<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Driver;

class SubDriver extends Model
{
    use HasFactory;

    protected $table = 'sub_driver';
    protected $guarded = [];

    protected $fillable = [
        'driver_id',
        'name',
        'phone_number',
        'license_number',
        'city_name',
        'address',
        'dl_frontImage',
        'dl_backImage',
        'aadhar_frontImage',
        'aadhar_backImage',
    ];

    /**
     * Get the driver associated with this sub driver
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
