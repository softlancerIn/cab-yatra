<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class BookingRatingReview extends Model
{
    use HasFactory;

    protected $table = 'booking_rating_reviews';
    protected $guarded = [];
}
