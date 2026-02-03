<?php

namespace App\Services\V2;

use App\Models\BookingRatingReview;
use App\Models\DriverCarDetails;
use App\Models\Driver;

class CommonServices
{
    //====================== image Upload ======================//
    public function fileupload($file, $type)
    {
        $path = public_path('/uploads/') . $type;
        if (file_exists($path)) {
            $filename = time() . '-' . $type . '-' . $file->getClientOriginalName();
            $file->move($path, $filename);
            return $filename;
        } else {
            mkdir($path, 0777, true);
            $filename = time() . '-' . $type . '-' . $file->getClientOriginalName();
            $file->move($path, $filename);
            return $filename;
        }
    }
    //====================== image Upload ======================//

    public function calculateDriverRating(int $driverId)
    {
        $rating = BookingRatingReview::where('driver_id', $driverId)->avg('rating');

        return number_format($rating, 1);
    }

    public function getDriverVehicles(int $driverId)
    {
        $driver = Driver::findOrFail($driverId);

        return DriverCarDetails::where('driver_id', $driver->id)->get();
    }

    public function getCarCategories()
    {
        return \App\Models\CarCategory::all();
    }
}
