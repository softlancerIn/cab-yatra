<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Driver;
use App\Models\cabBooking;

class BookingChatRequest extends Model
{
    use HasFactory;

    protected $table = 'booking_chat_request';
    protected $guarded = [];

    protected $fillable = [
        'booking_id',
        'driver_id',
        'message',
    ];

    /**
     * Get the booking associated with this chat request
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(cabBooking::class, 'booking_id');
    }

    /**
     * Get the driver associated with this chat request
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
