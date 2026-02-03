<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\V2\SubDriver;
use App\Models\Driver;

class SubDriverController extends Controller
{
    /**
     * Get all sub drivers
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            
            $subDrivers = SubDriver::with(['driver'])
                ->paginate($perPage);

            return response()->json([
                'status' => true,
                'message' => 'Sub drivers retrieved successfully',
                'data' => $subDrivers,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching sub drivers: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving sub drivers',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get sub drivers by driver ID
     */
    public function getByDriver($driverId)
    {
        try {
            $subDrivers = SubDriver::where('driver_id', $driverId)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Sub drivers retrieved successfully',
                'data' => $subDrivers,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching sub drivers: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving sub drivers',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new sub driver
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'driver_id' => 'required|exists:drivers,id',
                'name' => 'required|string',
                'phone_number' => 'required|string',
                'license_number' => 'nullable|string',
                'city_name' => 'nullable|string',
                'address' => 'nullable|string',
                'dl_frontImage' => 'nullable|string',
                'dl_backImage' => 'nullable|string',
                'aadhar_frontImage' => 'nullable|string',
                'aadhar_backImage' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $subDriver = SubDriver::create($request->only([
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
            ]));

            return response()->json([
                'status' => true,
                'message' => 'Sub driver created successfully',
                'data' => $subDriver,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating sub driver: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error creating sub driver',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a single sub driver
     */
    public function show($id)
    {
        try {
            $subDriver = SubDriver::with(['driver'])
                ->find($id);

            if (!$subDriver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sub driver not found',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Sub driver retrieved successfully',
                'data' => $subDriver,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching sub driver: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving sub driver',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a sub driver
     */
    public function update(Request $request, $id)
    {
        try {
            $subDriver = SubDriver::find($id);

            if (!$subDriver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sub driver not found',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'driver_id' => 'sometimes|required|exists:drivers,id',
                'name' => 'sometimes|required|string',
                'phone_number' => 'sometimes|required|string',
                'license_number' => 'nullable|string',
                'city_name' => 'nullable|string',
                'address' => 'nullable|string',
                'dl_frontImage' => 'nullable|string',
                'dl_backImage' => 'nullable|string',
                'aadhar_frontImage' => 'nullable|string',
                'aadhar_backImage' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $subDriver->update($request->only([
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
            ]));

            return response()->json([
                'status' => true,
                'message' => 'Sub driver updated successfully',
                'data' => $subDriver,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating sub driver: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error updating sub driver',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a sub driver
     */
    public function destroy($id)
    {
        try {
            $subDriver = SubDriver::find($id);

            if (!$subDriver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sub driver not found',
                ], 404);
            }

            $subDriver->delete();

            return response()->json([
                'status' => true,
                'message' => 'Sub driver deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting sub driver: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error deleting sub driver',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
