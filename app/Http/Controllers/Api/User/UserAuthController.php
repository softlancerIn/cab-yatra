<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Services\CommonServices;

use App\Models\{
    DriverCarDetails,
    Driver,
    User,
};
use DB;

class UserAuthController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}

    public function sendOtp(Request $request)
    {
        if ($request->isMethod('GET')) {
            return response()->json([
                'status' => false,
                'message' => 'Support Only POST method',
            ], 405);
        }

        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $otp = '1234';

        $checkUser = User::updateOrCreate(
            [
                'mobile' => $request->mobile,
            ],
            [
                'mobile' => $request->mobile,
                'otp' => $otp,
            ]
        );


        return response()->json([
            'status' => true,
            'message' => 'Otp Send Successfully!',
            'otp' => $otp,
        ], 200);
    }


    public function registration(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => ['required', 'in:car_details,driver_details'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 400);
            }


            if ($request->type == 'driver_details') {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'aadhar_no' => 'required|numeric',
                    'pan_no' => 'required',
                    'dl_no' => 'required',
                    'driver_image' => 'required|mimes:jpg,jpeg,png,webp,avif',
                    'aadhar_frontImage' => 'required|mimes:jpg,jpeg,png,webp,avif',
                    'aadhar_backImage' => 'required|mimes:jpg,jpeg,png,webp,avif',
                    'dl_image' => 'required|mimes:jpg,jpeg,png,webp,avif',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors(),
                    ], 422);
                }


                $uniqId = "#DRIVERID" . rand(10000, 99999);

                $driverData = $request->only(['name', 'email', 'phone', 'aadhar_no', 'pan_no', 'dl_no']);
                $driverData['uniqId'] = $uniqId;
                $driverData['driver_image'] = $this->commonServices->fileupload($request->file('driver_image'), 'driver_photo');
                $driverData['aadhar_frontImage'] = $this->commonServices->fileupload($request->file('aadhar_frontImage'), 'aadhar_front_image');
                $driverData['aadhar_backImage'] = $this->commonServices->fileupload($request->file('aadhar_backImage'), 'aadhar_back_image');
                $driverData['dl_image'] = $this->commonServices->fileupload($request->file('dl_image'), 'dl_image');

                $driver = Driver::create($driverData);

                return response()->json([
                    'status' => true,
                    'message' => 'Driver Details Added Successfully!',
                    'driver_id' => $driver->id,
                ], 200);
            }

            if ($request->type == 'car_details') {
                $validator = Validator::make($request->all(), [
                    'driver_id' => 'required|exists:driver,id',
                    'car_brand' => 'required',
                    'car_name' => 'required',
                    'car_no' => 'required',
                    'fuel_type' => ['required', 'in:0,1,2,3,4'],
                    'no_seat' => 'required|numeric',
                    'insurence_expiry' => 'required|date',
                    'car_image' => 'required|mimes:jpg,jpeg,png,webp,avif',
                    'insurence_image' => 'required|mimes:jpg,jpeg,png,webp,avif',
                    'car_rc_frontImage' => 'required|mimes:jpg,jpeg,png,webp,avif',
                    'car_rc_backImage' => 'required|mimes:jpg,jpeg,png,webp,avif',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors(),
                    ], 400);
                }

                $carData = $request->only(['driver_id', 'car_brand', 'car_name', 'car_no', 'fuel_type', 'no_seat', 'insurence_expiry']);
                $carData['car_image'] = $this->commonServices->fileupload($request->file('car_image'), 'car_image');
                $carData['insurence_image'] = $this->commonServices->fileupload($request->file('insurence_image'), 'insurence_photo');
                $carData['car_rc_frontImage'] = $this->commonServices->fileupload($request->file('car_rc_frontImage'), 'carRc_front_image');
                $carData['car_rc_backImage'] = $this->commonServices->fileupload($request->file('car_rc_backImage'), 'carRc_back_image');

                DriverCarDetails::create($carData);
                Driver::where('id', $request->driver_id)->update(['is_registered' => '1']);

                return response()->json([
                    'status' => true,
                    'message' => 'Driver Registered Successfully!',
                ], 200);
            }

            return response()->json([
                'error' => 'Invalid type provided',
            ], 400);
        } catch (\Throwable $e) {
            Log::error('Error in Registration process: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'data' => ''
            ], 400);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed!',
                'error' => $validator->errors(),
            ], 422);
        }

        $check = User::where('mobile', $request->mobile)->first();
        if (!$check) {
            return response()->json([
                'status' => false,
                'message' => 'Mobile number not registered!',
                'user_type' => '',
                'data' => null,
            ]);
        }

        if ($check->otp != $request->otp) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect OTP!',
                'user_type' => '',
                'data' => null,
            ]);
        }

        $user_type = empty($user->name) ? 'New' : 'Old';

        $token = $check->createToken('UserToken', ['user'])->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Logged In Successfully!',
            'user_type' => $user_type,
            'token' => $token,
            'data' => $check
        ], 200);
    }

    public function testing(Request $request)
    {
        $token = request()->header('token');
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'orderId' => 'required',
            'orderStatus' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $update = DB::table('testing')->where('orderId', $request->orderId)->update([
            'orderStatus' => $request->orderStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data upadted Successfully!',
        ], 200);
    }
}
