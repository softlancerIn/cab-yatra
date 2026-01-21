<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CommonServices;

use App\Models\{
    DriverCarDetails,
    Driver,
};
use DB;

class AuthController extends Controller
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

        $otp = '1234'; // for testing purpose
         // In production, generate a random OTP

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
                'mobile' => 'required|numeric|digits:10|unique:driver,phone',
                'name'  => 'required|string|max:100',
                'city'  => 'required|string|max:100',
                'otp'   => 'required|numeric|digits:4',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            // 🔐 Example OTP check (replace with DB or cache logic)
            if ($request->otp != '1234') {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP',
                ], 400);
            }

            $driver = Driver::create([
                'uniqId' => '#DRIVERID' . rand(10000, 99999),
                'name'   => $request->name,
                'phone'  => $request->mobile,
                'city'   => $request->city,
                'is_registered' => '0',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Registration successful',
                'driver_id' => $driver->id,
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Registration Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'.$e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed!',
                'error' => $validator->errors(),
            ], 422);
        }

        $check = Driver::where('phone', $request->mobile)->first();

        if (!$check) {
            return response()->json([
                'status' => false,
                'message' => 'Mobile number not registered!',
                'user_type' => 'New'
            ]);
        }

        if ($check->is_registered == '0') {
            return response()->json([
                'status' => false,
                'message' => 'Driver not registered!',
                'is_registered' => '0',
                'user_type' => 'Old'
            ]);
        }

        if ($check->is_verified == '0') {
            return response()->json([
                'status' => false,
                'message' => 'Account not verified!',
                'is_registered' => '1',
                'user_type' => 'Old'
            ]);
        }

        $token = $check->createToken('DriverToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Logged In Successfully!',
            'is_registered' => '1',
            'user_type' => 'Old',
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
