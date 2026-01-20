<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cabBooking;

class AssignBooking extends Model
{
    use HasFactory;


    protected $table = 'assign_booking';
    protected $guarded = [];

    /**
     * Get the user that owns the AssignBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingData()
    {
        return $this->belongsTo(cabBooking::class, 'booking_id', 'id');
    }
}
