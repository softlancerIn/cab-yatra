<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\V2\CommonServices;
use App\Models\cabBooking as Booking;
use DB;
use App\Traits\SanctumAuthTrait;
use App\Http\Requests\Admin\V2\BookingRequest;

class BookingController extends Controller
{
    use SanctumAuthTrait;

    public function __construct(public CommonServices $commonServices) {}

    /**
     * Fetch all bookings
     */
    public function index(Request $request)
    {
        try {
            $bookings = Booking::all();

            return response()->json([
                'status' => true,
                'message' => 'Bookings fetched successfully',
                'data' => $bookings,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching bookings: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch bookings',
            ], 500);
        }
    }

    /**
     * Store a new booking.
     * Take reference from API HomeController addToBooking function.
     */
    public function store(BookingRequest $request)
    {
        $user = $this->sanctumUser();
        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }

        try {
            $booking = Booking::create([
                'orderId' => rand(10000, 99999),
                'driver_id' => $user->id,
                'type' => '1',
                'subType' => $request->subType,
                'carCategory_id' => $request->carCategoryId,
                'pickUp_date' => $request->pickUp_date,
                'pickUp_time' => $request->pickUp_time,
                'pickUpLoc' => implode(',', $request->pickUpLoc),
                'destinationLoc' => implode(',', $request->destinationLoc),
                'total_faire' => $request->total_faire,
                'driverCommission' => $request->driverCommission,
                'is_show_phoneNumber' => $request->is_show_phoneNumber,
                'is_driver_createBooking' => '1',
                'is_assigned' => '1',
                'remark' => $request->remarks,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Booking created successfully',
                'data' => $booking,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating booking: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create booking',
            ], 500);
        }
    }

    /**
     * Fetch a specific booking
     */

    public function show($id)
    {
        try {
            $booking = Booking::with('carCategory:id,name')
                ->select([
                    'id',
                    'orderId',
                    'driver_id',
                    'subType',
                    'carCategory_id',
                    'pickUp_date',
                    'pickUp_time',
                    'pickUpLoc',
                    'destinationLoc',
                    'total_faire',
                    'driverCommission',
                    'is_show_phoneNumber',
                    'is_driver_createBooking',
                    'is_assigned',
                    'remark',
                ])
                ->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Booking fetched successfully',
                'data' => $booking,
            ], 200);
        } catch (\Exception $e) {
            // Log::error('Error fetching booking: ' . $e->getMessage());
            dd($e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch booking',
            ], 500);
        }
    }


    /**
     * Update a specific booking
     */
    public function update(BookingRequest $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);

            $booking->update([
                'subType' => $request->subType,
                'carCategory_id' => $request->carCategoryId,
                'pickUp_date' => $request->pickUp_date,
                'pickUp_time' => $request->pickUp_time,
                'pickUpLoc' => is_array($request->pickUpLoc)
                    ? implode(',', $request->pickUpLoc)
                    : $request->pickUpLoc,
                'destinationLoc' => is_array($request->destinationLoc)
                    ? implode(',', $request->destinationLoc)
                    : $request->destinationLoc,
                'total_faire' => $request->total_faire,
                'driverCommission' => $request->driverCommission,
                'is_show_phoneNumber' => $request->is_show_phoneNumber,
                'remark' => $request->remarks,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Booking updated successfully',
                'data' => $booking,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error updating booking: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update booking',
            ], 500);
        }
    }



    /**
     * Delete a specific booking
     */
    public function destroy($id)
    {
        try {
            Booking::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Booking deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting booking: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete booking',
            ], 500);
        }
    }

    public function updateAssignMethod(BookingRequest $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);

            $booking->fill($request->only([
                'assignType',
            ]));

            $booking->save();

            return response()->json([
                'status' => true,
                'message' => 'Booking assignment updated successfully',
                'data' => $booking,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error updating booking assignment: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update booking assignment',
            ], 500);
        }
    }

    public function getCarCategory()
    {
        try {
            $carCategories = $this->commonServices->getCarCategories();

            return response()->json([
                'status' => true,
                'message' => 'Car categories fetched successfully',
                'data' => $carCategories,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching car categories: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch car categories',
            ], 500);
        }
    }
}
