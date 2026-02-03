<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CommonServices;
use App\Models\V2\Alert;
use App\Models\DriverCarDetails;
use DB;

class AlertController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}

    /**
     * Fetch all cars details
     */
    public function index(Request $request)
    {
        try {
            $cars = DriverCarDetails::where('status', '1')->get();

            return response()->json([
                'status' => true,
                'message' => 'Cars fetched successfully',
                'data' => $cars,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching cars: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch cars',
            ], 500);
        }
    }

    /**
     * Store a new alert
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id'   => 'required|exists:driver,id',
            'aleart_type' => 'nullable|string',
            'cars_id'     => 'nullable|array',
            'locations'   => 'nullable|array',
            'manually_pickup' => 'required|in:yes,no',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $alert = Alert::create([
                'driver_id'      => $request->driver_id,
                'aleart_type'    => $request->aleart_type,
                'cars_id'        => json_encode($request->cars_id),
                'locations'      => json_encode($request->locations),
                'manually_pickup' => $request->manually_pickup,
                'status'         => '1',
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Alert created successfully',
                'data'    => $alert,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating alert: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create alert',
            ], 500);
        }
    }
}
