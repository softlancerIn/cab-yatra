<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\V2\BookingChatRequest;
use App\Models\cabBooking;
use App\Models\Driver;

class BookingChatRequestController extends Controller
{
    /**
     * Get all booking chat requests
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            
            $chatRequests = BookingChatRequest::with(['booking', 'driver'])
                ->paginate($perPage);

            return response()->json([
                'status' => true,
                'message' => 'Booking chat requests retrieved successfully',
                'data' => $chatRequests,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching booking chat requests: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving booking chat requests',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get chat requests for a specific booking
     */
    public function getByBooking($bookingId)
    {
        try {
            $chatRequests = BookingChatRequest::where('booking_id', $bookingId)
                ->with(['driver'])
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Chat requests retrieved successfully',
                'data' => $chatRequests,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching chat requests for booking: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving chat requests',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new booking chat request
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'booking_id' => 'required|exists:cab_bookings,id',
                'driver_id' => 'required|exists:drivers,id',
                'message' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $chatRequest = BookingChatRequest::create($request->only([
                'booking_id',
                'driver_id',
                'message',
            ]));

            return response()->json([
                'status' => true,
                'message' => 'Chat request created successfully',
                'data' => $chatRequest,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating booking chat request: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error creating chat request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a single booking chat request
     */
    public function show($id)
    {
        try {
            $chatRequest = BookingChatRequest::with(['booking', 'driver'])
                ->find($id);

            if (!$chatRequest) {
                return response()->json([
                    'status' => false,
                    'message' => 'Chat request not found',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Chat request retrieved successfully',
                'data' => $chatRequest,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching chat request: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving chat request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a booking chat request
     */
    public function update(Request $request, $id)
    {
        try {
            $chatRequest = BookingChatRequest::find($id);

            if (!$chatRequest) {
                return response()->json([
                    'status' => false,
                    'message' => 'Chat request not found',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'booking_id' => 'sometimes|required|exists:cab_bookings,id',
                'driver_id' => 'sometimes|required|exists:drivers,id',
                'message' => 'sometimes|required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $chatRequest->update($request->only([
                'booking_id',
                'driver_id',
                'message',
            ]));

            return response()->json([
                'status' => true,
                'message' => 'Chat request updated successfully',
                'data' => $chatRequest,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating chat request: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error updating chat request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a booking chat request
     */
    public function destroy($id)
    {
        try {
            $chatRequest = BookingChatRequest::find($id);

            if (!$chatRequest) {
                return response()->json([
                    'status' => false,
                    'message' => 'Chat request not found',
                ], 404);
            }

            $chatRequest->delete();

            return response()->json([
                'status' => true,
                'message' => 'Chat request deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting chat request: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error deleting chat request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
