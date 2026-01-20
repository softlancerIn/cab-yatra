<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TourPackages;

class TourPackageBooking extends Model
{
    use HasFactory;

    protected $table = 'tour_package_booking';
    protected $guarded = [];

    /**
     * Get the user that owns the TourPackageBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tourPackage()
    {
        return $this->belongsTo(TourPackages::class, 'tour_pkgId', 'id');
    }
}
