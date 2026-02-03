<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\CommonServices;
use Illuminate\Http\Request;
use App\Traits\SanctumAuthTrait;
use App\Http\Requests\Admin\V2\ProfileRequest;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProfileResource;
use App\Models\DriverCarDetails;

class VehicleController extends Controller
{
    use SanctumAuthTrait;

    public function __construct(public CommonServices $commonServices) {}

    public function index()
    {
        $user = $this->sanctumUser();

        try {
            $vehicles = $this->commonServices->getDriverVehicles($user->id);
    
            return response()->json([
                'status'  => true,
                'message' => 'Vehicles fetched successfully',
                'data'    => $vehicles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error fetching vehicles: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $user = $this->sanctumUser();
        $driver = Driver::findOrFail($user->id);

        $validatedData = $request->validate([
            'car_category_id'          => 'required|string',
            'year_of_mfg'           => 'required|integer',
            'registration_number'   => 'required|integer',
            'insurance_document'    => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'insurance_exp'         => 'nullable|date',
            'rc_front_image'        => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'rc_back_image'         => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'car_image1'        => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'car_image2'        => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $carDetails = new DriverCarDetails();
        $carDetails->driver_id = $driver->id;
        // $carDetails->vehicle_type = $validatedData['vehicle_type'];
        $carDetails->car_category_id = $validatedData['car_category_id'];
        $carDetails->manifacturer_of_year = $validatedData['year_of_mfg'];
        $carDetails->car_registration_number = $validatedData['registration_number'];

        if ($request->hasFile('insurance_document')) {
            $carDetails->insurence_image = $this->commonServices->fileupload($request->file('insurance_document'), 'insurance_documents');
        }

        if ($request->hasFile('rc_front_image')) {
            $carDetails->car_rc_frontImage = $this->commonServices->fileupload($request->file('rc_front_image'), 'rc_images');
        }

        if ($request->hasFile('rc_back_image')) {
            $carDetails->car_rc_backImage = $this->commonServices->fileupload($request->file('rc_back_image'), 'rc_images');
        }

        if ($request->hasFile('car_image1')) {
            $carDetails->car_image1 = $this->commonServices->fileupload($request->file('car_image1'), 'vehicle_photos');
        }

        if ($request->hasFile('car_image2')) {
            $carDetails->car_image2 = $this->commonServices->fileupload($request->file('car_image2'), 'vehicle_photos');
        }

        if (isset($validatedData['insurance_exp'])) {
            $carDetails->insurence_expiry = \Carbon\Carbon::parse($validatedData['insurance_exp']);
        }

        try {
            DB::beginTransaction();

            $carDetails->save();

            DB::commit();

            return response()->json([
                "status"  => true,
                "message" => "Vehicle created successfully.",
                "data"    => $carDetails
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                "status"  => false,
                "message" => "Error creating vehicle: " . $e->getMessage(),
                "data"    => null
            ], 500);
        }
    }

    public function show($id)
    {
        $user = $this->sanctumUser();

        try {
            $vehicle = DriverCarDetails::where('driver_id', $user->id)->findOrFail($id);
    
            return response()->json([
                'status'  => true,
                'message' => 'Vehicle fetched successfully',
                'data'    => $vehicle
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error fetching vehicle: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = $this->sanctumUser();

        try {
            $driver = Driver::findOrFail($user->id);
            $vehicle = DriverCarDetails::where('driver_id', $driver->id)->findOrFail($id);
    
            $vehicle->fill($request->only([
                'car_category_id',
                'year_of_mfg',
                'registration_number',
                'insurance_document',
                'insurance_exp',
                'rc_front_image',
                'rc_back_image',
                'car_image1',
                'car_image2',
            ]));
    
            if ($request->hasFile('insurance_document')) {
                $vehicle->insurence_image = $this->commonServices->fileupload($request->file('insurance_document'), 'insurance_documents');
            }
    
            if ($request->hasFile('rc_front_image')) {
                $vehicle->car_rc_frontImage = $this->commonServices->fileupload($request->file('rc_front_image'), 'rc_images');
            }
    
            if ($request->hasFile('rc_back_image')) {
                $vehicle->car_rc_backImage = $this->commonServices->fileupload($request->file('rc_back_image'), 'rc_images');
            }
    
            if ($request->hasFile('car_image1')) {
                $vehicle->car_image1 = $this->commonServices->fileupload($request->file('car_image1'), 'vehicle_photos');
            }
    
            if ($request->hasFile('car_image2')) {
                $vehicle->car_image2 = $this->commonServices->fileupload($request->file('car_image2'), 'vehicle_photos');
            }
    
            $vehicle->save();
    
            return response()->json([
                'status'  => true,
                'message' => 'Vehicle updated successfully',
                'data'    => $vehicle
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error updating vehicle: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $user = $this->sanctumUser();

        try {
            $driver = Driver::findOrFail($user->id);
            $vehicle = DriverCarDetails::where('driver_id', $driver->id)->findOrFail($id);
    
            $vehicle->delete();
    
            return response()->json([
                'status'  => true,
                'message' => 'Vehicle deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error deleting vehicle: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getByDriver($driverId)
    {
        try {
            $vehicles = DriverCarDetails::where('driver_id', $driverId)->get();
    
            return response()->json([
                'status'  => true,
                'message' => 'Vehicles fetched successfully',
                'data'    => $vehicles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error fetching vehicles: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function updateDriverDetails(Request $request, Driver $driver): void
    {
        $driver->fill($request->only([
            'name',
            'type',
            'license_number',
        ]));

        if ($image = $this->uploadIfExists($request, 'driver_image', 'driver_photo')) {
            $driver->driver_image = $image;
        }

        $driver->save();
    }


    private function uploadIfExists(Request $request, string $key, string $folder)
    {
        return $request->hasFile($key)
            ? $this->commonServices->fileupload($request->file($key), $folder)
            : null;
    }
}