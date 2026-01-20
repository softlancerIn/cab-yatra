<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignBooking;
use App\Models\Driver;
use App\Models\cabBooking;

class DriverRatingReviewController extends Controller
{
    public function getDriverDataForRatingReview(Request $request, $bookingId)
    {
        $data = [];
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }


        // Fetch the driver data for the given booking ID
        $driverData = $this->fetchDriverData($bookingId);
        if ($driverData) {
            return response()->json([
                'status' => true,
                'message' => 'Driver data fetched successfully',
                'data' => $driverData,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No driver data found for this booking ID',
            ]);
        }
    }
    public function submitRatingReview(Request $request)
    {
        // Validate the request
        $request->validate([
            'booking_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        // Save the rating and review
        $result = $this->saveRatingReview($request->booking_id, $request->rating, $request->review);

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'Rating and review submitted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to submit rating and review',
            ]);
        }
    }
    private function fetchDriverData($bookingId)
    {
        $assignData = AssignBooking::where('booking_id', $bookingId)->first();
        if (!$assignData) {
            return null;
        }
        $driverId = $assignData->driver_id;
        $driverData = Driver::where('id', $driverId)->first(['id', 'name']);
        if (!$driverData) {
            return null;
        }

        return [
            'driver_id' => $driverData->id,
            'name' => $driverData->name,
        ];
    }
    private function saveRatingReview($bookingId, $rating, $review)
    {
        // Logic to save rating and review
        // This is a placeholder. Replace with actual logic.
        return true;
    }
}
