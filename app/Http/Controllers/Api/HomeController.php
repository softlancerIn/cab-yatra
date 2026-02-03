<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\CommonServices;
use Illuminate\Http\Request;
use App\Models\Driver;
use Carbon\Carbon;

use App\Models\{
    DriverBookingComission,
    DriverCreateBooking,
    DriverPaymentMethod,
    BookingRatingReview,
    WalletTransaction,
    WithdrawalRequest,
    StartRideOtp,
    TimeSchadule,
    AssignBooking,
    CarCategory,
    cabBooking,
    AppBanner,
    Settings,
    Time,
    Cars,
    DriverCarDetails
};

use App\Mail\{
    UserConfirmBooking
};
use Mail;

use App\Traits\SanctumAuthTrait;


class HomeController extends Controller
{
    use SanctumAuthTrait;

    public function __construct(public CommonServices $commonServices) {}
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $app_banner = AppBanner::where('status', '1')->get(['id', 'name', 'image', 'url']);

        //========================== New Booking ===========================================//
        $new_booking = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])->where(['is_assigned' => '1', 'is_driver_accepted' => '0'])->select(['id', 'orderId', 'type', 'subType', 'is_airpotToFrom', 'mobile', 'pickUp_date', 'pickUp_time', 'timeSchadule_id', 'total_faire', 'include_km', 'online_payment', 'offline_payment', 'driver_comission', 'pickUpLoc', 'destinationLoc', 'carCategory_id', 'add_onService', 'is_driver_accepted', 'is_driver_createBooking', 'is_show_phoneNumber', 'remark', 'destination_date', 'fuel_type', 'extra_fair_perKm', 'toll', 'tax'])->orderBy('id', 'DESC')->paginate(10);

        $new_booking->getCollection()->transform(function ($item, $rating) {
            $item->url = '';
            return $item;
        });

        foreach ($new_booking as $key => $value2) {
            $value2->driver_number = '';
            if (($value2->is_driver_createBooking == '1') && $value2->is_show_phoneNumber == '1') {
                $value2->driver_number = $user->phone;
            }
        }

        $active_booking_ids = AssignBooking::where('driver_id', $user->id)
            ->orderBy('id', 'DESC')
            ->pluck('booking_id')
            ->toArray();

        $active_booking = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])
            ->where('is_assigned', '1')
            ->where('status', '!=', '0')
            ->whereIn('id', $active_booking_ids)
            ->select([
                'id',
                'orderId',
                'type',
                'subType',
                'timeSchadule_id',
                'is_airpotToFrom',
                'mobile',
                'pickUp_date',
                'pickUp_time',
                'total_faire',
                'include_km',
                'online_payment',
                'offline_payment',
                'driver_comission',
                'pickUpLoc',
                'destinationLoc',
                'carCategory_id',
                'add_onService',
                'is_driver_accepted',
                'is_driver_createBooking',
                'is_show_phoneNumber',
                'status',
                'remark',
                'destination_date',
                'fuel_type',
                'extra_fair_perKm',
                'toll',
                'tax',
            ])
            ->orderByRaw("FIELD(id, " . implode(',', $active_booking_ids) . ")")
            ->paginate(10);


        foreach ($active_booking as $key => $value) {
            $assign_booking = AssignBooking::where('booking_id', $value->id)->first(['id', 'booking_id', 'start_time', 'end_time', 'status']);
            $value->assign_booking_status = '0';
            $value->driver_number = "";
            if ($assign_booking) {
                $value->assign_booking_status = $assign_booking->status;
            }


            if (($value->is_driver_createBooking == '1') && $value->is_show_phoneNumber == '1') {
                $value->driver_number = $user->phone;
            }
        }

        $rating = $this->getDriverRating($user->id);
        return response()->json([
            'status' => true,
            'message' => 'Data Send Successfully!' . $rating,
            'banners' => $app_banner,
            'new_booking' => $new_booking,
            'active_booking' => $active_booking,
        ], 200);
    }

    public function getDriverRating($driverId)
    {
        $rating = BookingRatingReview::where('driver_id', $driverId)->avg('rating');
        return number_format($rating, 1);
    }

    public function myBooking(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }
        $my_booking = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])->where(['driver_id' => $user->id])->orderBy('id', 'DESC')->paginate(10);

        foreach ($my_booking as $key => $value) {
            $value->add_on_service = ($value->add_onService == 'null') ? [] : $value->add_onService;
            $value->driver_number = "";
            $value->is_rating = '0';

            $checkRating = BookingRatingReview::where(['booking_id' => $value->id, 'driver_id' => $user->id])->first();
            if ($checkRating) {
                $value->is_rating = '1';
            }

            if (($value->is_driver_createBooking == '1') && $value->is_show_phoneNumber == '1') {
                $value->driver_number = $user->phone;
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Booking List Send Successfuly!',
            'assign_booking' => [],
            'my_booking' => $my_booking,
        ], 200);
    }
    public function booking_details(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'booking_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }
        }

        $booking_data = cabBooking::with(['carCategory:id,name'])->where('id', $request->booking_id)->select(['id', 'orderId', 'type', 'subType', 'is_airpotToFrom', 'pickUp_date', 'pickUp_time', 'total_faire', 'online_payment', 'offline_payment', 'driver_comission', 'pickUpLoc', 'destinationLoc', 'carCategory_id'])->first();

        if ($booking_data) {
            return response()->json([
                'status' => true,
                'message' => 'Booking Details Send Successfully!',
                'data' => $booking_data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Booking Id not found!',
                'data' => '',
            ], 200);
        }
    }

    public function updateBookingStatus(Request $request)
    {
        $user = auth('sanctum')->user();

        try {

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token required!'
                ], 401);
            }

            // Mail to user for confirm booking 
            $mailData = '';
            $data = [];

            $validator = Validator::make($request->all(), [
                'booking_id' => 'required',
                'razorpyayOrderId' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }

            $status = '1';
            $data = cabBooking::where('id', $request->booking_id)->first();

            if ($data->is_driver_accepted == '1') {
                return response()->json([
                    'status' => false,
                    'message' => 'Booking Already acceted by another driver!',
                    'data' => ''
                ], 200);
            }

            $add = AssignBooking::updateOrCreate(
                [
                    'driver_id' => $user->id,
                    'booking_id' => $request->booking_id,
                ],
                [
                    'type' => '0',
                    'driver_id' => $user->id,
                    'booking_id' => $request->booking_id,
                    'online_amount' => $request->online_amount,
                    'offline_amount' => $request->offline_amount,
                    'status' => '0',
                ]
            );


            $update = cabBooking::where('id', $request->booking_id)->update([
                'is_driver_accepted' => '1',
                'payment_infoId' => $request->razorpyayOrderId,
                'status' => '1',
            ]);

            // // Mail to user for confirm booking 
            $mailData = $data->email;
            $data = [
                'orderId' => $data->orderId,
                'type' => $data->type,
                'subType' => $data->subType,
                'is_airpotToFrom' => $data->is_airpotToFrom,
                'pickUpLoc' => $data->pickUpLoc,
                'destinationLoc' => $data->destinationLoc,
                'pickUp_time' => $data->pickUp_time,
                'include_km' => $data->include_km,
                'extra_fair_perKm' => $data->extra_fair_perKm,
                'online_payment' => $data->online_payment,
                'offline_payment' => $data->offline_payment,
            ];

            Mail::to($mailData)->send(new UserConfirmBooking($data));
            Mail::to('cabyatrabooking@gmail.com')->send(new UserConfirmBooking($data));

            return response()->json([
                'status' => true,
                'message' => 'Booking Status Updated Successfully!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }

    public function checkBookingAcceptance($booking_id)
    {
        $checkBooking = AssignBooking::where(['booking_id' => $booking_id])->first();

        if ($checkBooking) {
            return true;
        } else {
            return false;
        }
    }

    public function completeBooking(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token required!'
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'booking_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }

            $is_driver_booking = '0';
            $cabData = cabBooking::find($request->booking_id);
            $cabData->status = '2';
            $cabData->update();

            $driver = Driver::find($user->id);
            if ($cabData->is_driver_createBooking == '1') {
                // create driver comission history
                DriverBookingComission::create([
                    'driver_id' => $user->id,
                    'booking_id' => $request->booking_id,
                    'comission_amt' => $cabData->driver_comission,
                ]);

                // Update Driver wallet
                $walletAmt = $driver->wallet + $cabData->driver_comission;
                $driver->wallet = $walletAmt;
                $driver->update();

                $is_driver_booking = '1';
            }

            if ($cabData->payment_mode == '1') {
                $walletAmt = $driver->wallet + $cabData->offline_payment;
                $driver->wallet = $walletAmt;
                $driver->update();
            }

            $add = AssignBooking::where(['driver_id' => $user->id, 'booking_id' => $request->booking_id,])->update([
                'online_amount' => $cabData->online_payment,
                'offline_amount' => $cabData->offline_payment,
                'fair_setteled' => '1',
                'status' => '2',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Booking Completed Successfully!',
                'data' => [
                    'is_driver_booking' => $is_driver_booking,
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }

    public function cancelBooking(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token required!'
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'booking_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }

            $cabData = cabBooking::find($request->booking_id);

            if (!$cabData) {
                return response()->json([
                    'status' => true,
                    'message' => 'Invlaid Booking Id!',
                ], 200);
            }

            $cabData->status = '3';
            $cabData->update();

            $add = AssignBooking::where(['driver_id' => $user->id, 'booking_id' => $request->booking_id])->update([
                'status' => '3',
                'fair_setteled' => '0',

            ]);

            return response()->json([
                'status' => true,
                'message' => 'Booking Cancel Successfully!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
    public function profile(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        if ($request->isMethod('GET')) {
            $profile = Driver::with('DriverCarDetails')->find($user->id);
            return response()->json([
                'status' => true,
                'message' => 'Profile Data Sent Successfully!',
                'data' => $profile,
            ], 200);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:car_details,driver_detail'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            if ($request->type === 'driver_detail') {
                $this->updateDriverDetails($request, $user->id);
            }

            if ($request->type === 'car_details') {
                $this->updateCarDetails($request, $user->id);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Driver Data Updated Successfully!',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'An error occurred!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getCarCategory(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $get_data = CarCategory::where('status', '1')->get(['id', 'name']);

        return response()->json([
            'status' => true,
            'message' => 'Car Category Send Successfully!',
            'data' => $get_data,
        ], 200);
    }

    public function addBooking(Request $request)
    {
        $user = $this->sanctumUser();

        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }

        try {
            $rules = [
                'car_category_id'     => 'required',
                'fuel_type'           => 'required',
                'trip_type'           => 'required',
                'pickup_address'      => 'required',
                'start_date'          => 'required',
                'start_time'          => 'required',
                'extra_price_perKm'   => 'required',
                'toll'                => 'required',
                'tax'                 => 'required',
                'total_amount'        => 'required',
                'comission'           => 'required',
                'add_on_service'      => 'required',
                'is_show_phoneNumber' => 'required',
            ];

            if ($request->trip_type == '0') {
                $rules['end_date'] = 'required';
                $rules['end_time'] = 'required';
            }

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }

            DB::beginTransaction();

            $tripTypes = [
                '0' => ['type' => '1', 'subType' => '0', 'prefix' => '#ORD_OSRTCB'],
                '1' => ['type' => '1', 'subType' => '1', 'prefix' => '#ORD_OSOWCB'],
                '2' => ['type' => '0', 'subType' => '2', 'prefix' => '#ORD_OSLACB'],
                '3' => ['type' => '0', 'subType' => '3', 'prefix' => '#ORD_LRTCB'],
            ];

            $tripInfo = $tripTypes[$request->trip_type] ?? [
                'type' => '0',
                'subType' => '0',
                'prefix' => '#ORD_DEFAULT',
            ];

            $orderId = $tripInfo['prefix'] . rand(10000, 99999);

            $timeScheduleId = null;
            if (!empty($request->time_schaduleId)) {
                $schedule = Time::where('id', $request->time_schaduleId)->first();
                $timeScheduleId = $schedule->id ?? null;
            }

            $onlinePayment = 0;

            $totalFare = $request->total_amount - $request->comission;

            $addOnServices = $request->add_on_service === 'Yes'
                ? ['assured_laugage']
                : [];

            $includedKm = $request->total_km ?: '0';

            $fuelType = $request->fuel_type == '-1'
                ? '1'
                : (string) $request->fuel_type;

            cabBooking::create([
                'driver_id' => $user->id,
                'orderId'   => $orderId,
                'type'      => $tripInfo['type'],
                'subType'   => $tripInfo['subType'],
                'carCategory_id' => $request->car_category_id,
                'name'      => $request->name ?? '',
                'mobile'    => $request->phone ?? '',
                'email'     => $request->email ?? 'testuser@gmail.com',
                'address'   => $request->address ?? '',
                'timeSchadule_id' => $timeScheduleId,
                'pickupLoc'       => json_encode($request->pickup_address),
                'destinationLoc'  => json_encode($request->destination_address),
                'pickUp_date'     => $request->start_date,
                'pickUp_time'     => $request->start_time,
                'destination_date' => $request->end_date ?? '',
                'destination_time' => $request->end_time ?? '',
                'fuel_type'       => $fuelType,
                'coupon_id'       => $request->coupon_id ?? '',
                'biling_name' => $request->biling_name ?? '',
                'biling_gstNo' => $request->biling_gstNo ?? '',
                'add_onService' => json_encode($addOnServices),
                'payment_mode' => $request->payment_mode ?? '2',
                'total_faire' => $totalFare,
                'payment_infoId' => $request->razorpay_no ?? '',
                'online_payment' => $onlinePayment,
                'offline_payment' => $totalFare,
                'include_km' => $includedKm,
                'extra_fair_perKm' => $request->extra_price_perKm,
                'toll' => $request->toll,
                'tax' => $request->tax,
                'driver_comission' => $request->comission,
                'remark' => $request->special_requirment ?? '',
                'is_assigned' => '1',
                'is_show_phoneNumber' => $request->is_show_phoneNumber,
                'is_driver_createBooking' => '1',
            ]);

            $mailData = $request->email;

            Mail::to('cabyatrabooking@gmail.com')->send(new UserConfirmBooking([
                'orderId' => $orderId,
                'type' => $tripInfo['type'],
                'subType' => $tripInfo['subType'],
                'is_airpotToFrom' => '',
                'pickUpLoc' => $request->pickup_address,
                'destinationLoc' => $request->destination_address,
                'pickUp_time' => $request->start_time,
                'include_km' => $includedKm,
                'extra_fair_perKm' => $request->extra_price_perKm,
                'online_payment' => $onlinePayment,
                'offline_payment' => $totalFare,
            ]));

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Booking Added Successfully!',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function upadteBooking(Request $request, $id)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        try {
            $checkBooking = $this->checkBookingAcceptance($id);

            if ($checkBooking) {
                return response()->json([
                    'status' => false,
                    'message' => 'Booking Already acceted by another driver!',
                    'data' => ''
                ], 200);
            }

            $baseRules = [
                'car_category_id' => 'required',
                'fuel_type' => 'required',
                'start_date' => 'required',
                'start_time' => 'required',
                'extra_price_perKm' => 'required',
                'total_amount' => 'required',
                'comission' => 'required',
                'is_show_phoneNumber' => 'required',
            ];

            $bookingData = cabBooking::find($id);
            if (!$bookingData) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Booking Id',
                    'data' => ''
                ], 200);
            }

            if (!empty($request->trip_type) && $request->trip_type == '0') {
                $baseRules['end_date'] = 'required';
                $baseRules['end_time'] = 'required';
            }
            $validator = Validator::make($request->all(), $baseRules);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }

            DB::beginTransaction();

            $tripTypes = [
                '0' => ['type' => '1', 'subType' => '0', 'prefix' => '#ORD_OSRTCB'],
                '1' => ['type' => '1', 'subType' => '1', 'prefix' => '#ORD_OSOWCB'],
                '2' => ['type' => '0', 'subType' => '2', 'prefix' => '#ORD_OSLACB'],
                '3' => ['type' => '0', 'subType' => '3', 'prefix' => '#ORD_LRTCB'],
            ];

            $tripTypes['type'] = $bookingData->type;
            $tripTypes['subType'] = $bookingData->subType;

            if (!empty($request->trip_type)) {
                $tripInfo = $tripTypes[$request->trip_type] ?? ['type' => '0', 'subType' => '0', 'prefix' => '#ORD_DEFAULT'];
                $orderId = $tripInfo['prefix'] . rand(10000, 99999);
            } else {
                $tripInfo['type'] = $bookingData->type;
                $tripInfo['subType'] = $bookingData->subType;
                $orderId = $bookingData->orderId;
            }

            $timeScheduleId = $bookingData->timeSchadule_id;
            if (!empty($request->time_schaduleId)) {
                $schedule = Time::where('id', $request->time_schaduleId)->first();
                $timeScheduleId = $schedule->id ?? null;
            }

            $totalFare = ($request->total_amount - $request->comission);
            $add_on_services = json_decode($bookingData->add_onService);
            if ($request->add_on_service === 'Yes') {
                $add_on_services = ['assured_laugage'];
            }

            $onlinePayment = 0;
            $offlinePayment = $totalFare;

            $pickupLoc = $bookingData->pickUpLoc;
            $destinationLoc = $bookingData->destinationLoc;
            if (!empty($request->pickup_address)) {
                $pickupLoc = json_encode($request->pickup_address);
            }
            if (!empty($request->destination_address)) {
                $destinationLoc = json_encode($request->destination_address);
            }

            $includedKm = $request->total_km;
            if (($includedKm == '') || $includedKm == null || $includedKm == '0') {
                $includedKm = '0';
            }


            $booking = cabBooking::where('id', $id)->update([
                'driver_id' => $user->id,
                'orderId' => $orderId,
                'type' => $tripInfo['type'],
                'subType' => $tripInfo['subType'],
                'carCategory_id' => $request->car_category_id ?? $bookingData->carCategory_id,
                'name' => $request->name ?? $bookingData->name,
                'mobile' => $request->phone ?? $bookingData->mobile,
                'email' => $request->email ??  $bookingData->email,
                'address' => $request->address ?? $bookingData->address,
                'timeSchadule_id' => $timeScheduleId,
                'pickupLoc' => $pickupLoc,
                'destinationLoc' => $destinationLoc,
                'pickUp_date' => $request->start_date,
                'pickUp_time' => $request->start_time,
                'destination_date' => $request->end_date ?? $bookingData->destination_date,
                'destination_time' => $request->end_time ?? $bookingData->destination_time,
                'fuel_type' => (string)$request->fuel_type ?? $bookingData->fuel_type,
                'coupon_id' => $request->coupon_id ?? $bookingData->coupon_id,
                'biling_name' => $request->biling_name ?? $bookingData->biling_name,
                'biling_gstNo' => $request->biling_gstNo ?? $bookingData->biling_gstNo,
                'add_onService' => json_encode($add_on_services ?? []),
                'payment_mode' => $request->payment_mode ?? $bookingData->payment_mode,
                'total_faire' => $totalFare,
                'payment_infoId' => $request->razorpay_no ?? $bookingData->payment_infoId,
                'online_payment' => $onlinePayment,
                'offline_payment' => $offlinePayment,
                'include_km' => $includedKm,
                'extra_fair_perKm' => $request->extra_price_perKm ?? $bookingData->extra_fair_perKm,
                'driver_comission' => $request->comission ?? $bookingData->driver_comission,
                'remark' => $request->special_requirment ?? $bookingData->remark,
                'is_assigned' => '1',
                'toll' => $request->toll,
                'tax' => $request->tax,
                'is_show_phoneNumber' => $request->is_show_phoneNumber ?? $bookingData->is_show_phoneNumber,
                'is_driver_createBooking' => '1',
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Booking Updated Successfuly!',
                'data' => '',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'data' => $th->getMessage(),
            ], 200);
        }
    }

    public function getBooking(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $get_data = DriverCreateBooking::where('id', $request->booking_id)->first();

        $get_data->total_faire = ($get_data->total_faire - $get_data->driver_comission);

        if (empty($get_data)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Booking Id',
                'data' => ''
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Booking Data Send Successfully!',
            'data' => $get_data
        ], 200);
    }

    public function deleteDriverBooking(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $data = cabBooking::where(['is_driver_createBooking' => '1', 'id' => $request->booking_id, 'driver_id' => $user->id])->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Booking Id',
                'data' => ''
            ], 200);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booking Data Deleted Successfully!',
        ], 200);
    }

    public function deleteBooking(Rwquest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $get_data = cabBooking::where('id', $request->booking_id)->first();
        $assign_data = AssignBooking::where('booking_id', $request->booking_id)->first();

        if (empty($get_data)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Booking Id',
                'data' => ''
            ], 200);
        }

        $assign_data->delete();
        $get_data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booking Data Deleted Successfully!',
            'data' => $get_data
        ], 200);
    }

    public function createRazorPayOrderId(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $orderId = $this->create_razorpay_order($request->amount);
        return response()->json([
            'status' => true,
            'message' => 'Order Id Send Successfully!',
            'data' => $orderId['id'],
        ], 200);
    }

    public function wallet(Request $request)
    {
        $data = [];
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        if ($request->isMethod('POST')) {
            try {
                $validator = Validator::make($request->all(), [
                    'amount' => 'required',
                    'type' => 'required|in:credit,debit',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors(),
                    ], 422);
                }

                $transaction_id = '';
                $razorpayId = '';
                $type = '0';


                if ($request->type == 'credit') {
                    $validator = Validator::make($request->all(), [
                        'razorpayId' => 'required',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'error' => $validator->errors(),
                        ], 422);
                    }


                    $type = '1';
                    $razorpayId = $request->razorpayId;
                    $transaction_id = '#CR_000' . rand(1000, 9999);

                    $driver = Driver::find($user->id);
                    $driver->wallet += $request->amount;
                    $driver->save();
                } else {
                    $transaction_id = '#DB_000' . rand(1000, 9999);


                    $driver = Driver::find($user->id);
                    $remain_wallet = $driver->wallet - $request->amount;

                    if ($remain_wallet < 1000) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Insufficient balance. Wallet cannot go below 1000 rupees.',
                            'data' => '',
                        ], 400);
                    }

                    $driver->wallet = $remain_wallet;
                    $driver->save();

                    $withdrawal = WithdrawalRequest::create([
                        'transaction_id' => $transaction_id,
                        'driver_id' => $user->id,
                        'amount' => $request->amount,
                    ]);
                }

                $add = WalletTransaction::create([
                    'driver_id' => $user->id,
                    'amount' => $request->amount,
                    'razorpayId' => $razorpayId,
                    'transaction_id' => $transaction_id,
                    'type' => $type,
                ]);

                $data = [
                    'status' => true,
                    'message' => 'Wallet Updated Successfully!',
                    'data' => $driver,
                ];
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data = [
                    'status' => false,
                    'message' => $th->getMessage(),
                ];
                return response()->json($data, 200);
            }
        }

        $driver = Driver::where('id', $user->id)->first(['id', 'wallet']);
        $transaction = WalletTransaction::where('driver_id', $user->id)->get();
        $data = [
            'status' => true,
            'message' => 'Wallet Data Send Successfully!',
            'driver_data' => $driver,
            'ransaction_data' => $transaction,
        ];
        return response()->json($data, 200);
    }

    public function cmsPages()
    {
        // $user = auth('sanctum')->user();

        // if (!$user) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Token required!'
        //     ], 401);
        // }

        $cms = Settings::where('id', '1')->first();
        $data = [
            'about_us' => $cms->about_us,
            'term_condition' => $cms->term_condition,
            'privacy_policy' => $cms->privacy_policy,
            'penalty' => $cms->penalty,
            'sla_agreements' => $cms->sla_agreements,
            'refund_policy' => $cms->refund_policy,
        ];
        return response()->json($data, 200);
    }
    public function bookingRatignReview(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        if ($request->isMethod('POST')) {
            try {
                $validator = Validator::make($request->all(), [
                    'booking_id' => 'required',
                    'rating' => 'required',
                    'driver_id' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors(),
                    ], 422);
                }

                $checkRating = BookingRatingReview::where(['booking_id' => $request->booking_id, 'rating_by' => 'Driver'])->first();
                if ($checkRating) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Already Rated!',
                        'data' => '',
                    ], 200);
                }


                $ratingReview = BookingRatingReview::updateOrCreate(
                    [
                        'booking_id' => $request->booking_id,
                    ],
                    [
                        'booking_id' => $request->booking_id,
                        'rating' => $request->rating ?? '',
                        'checkBox_review' => $request->checkBox_review ?? '',
                        'text_review' => $request->text_review ?? '',
                        'rating_by' => 'Driver',
                        'rating_by_id' => $user->id,
                        'driver_id' => $request->driver_id,
                    ]
                );

                $data = [
                    'status' => true,
                    'message' => 'Rating Review Added Successfully!',
                    'data' => '',
                ];
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data = [
                    'status' => false,
                    'message' => $th->getMessage(),
                    'data' => '',
                ];
                return response()->json($data, 200);
            }
        } else {
            $data = [
                'status' => false,
                'message' => 'Accepted Only Post Request!',
                'data' => '',
            ];
            return response()->json($data, 200);
        }
    }

    public function DriverPaymentMethod(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        if ($request->isMethod('POST')) {
            try {
                $validator = Validator::make($request->all(), [
                    'type' => 'required|in:1,0',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors(),
                    ], 422);
                }

                $qr_image = '';
                if ($request->has('qr_image') && !empty($request->file('qr_image'))) {
                    $qr_image = $this->commonServices->fileupload($request->file('qr_image'), 'driver_payment_method');
                }

                $addUpdate = DriverPaymentMethod::updateOrCreate(
                    [
                        'driver_id' => $user->id,
                        // 'type' => $request->type
                    ],
                    [
                        'driver_id' => $user->id ?? '',
                        'type' => $request->type,
                        'bank_name' => $request->bank_name ?? '',
                        'account_number' => $request->account_number ?? '',
                        'ifsc_code' => $request->ifsc_code ?? '',
                        'account_holderName' => $request->account_holderName ?? '',
                        'upi_id' => $request->upi_id ?? '',
                        'payment_number' => $request->payment_number ?? '',
                        'qr_image' => $qr_image ?? '',
                    ],
                );
                $data = [
                    'status' => true,
                    'message' => 'Driver Payment Method Added Successfully!',
                ];
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data = [
                    'status' => true,
                    'message' => $th->getMessage(),
                    'data' => '',
                ];
                return response()->json($data, 200);
            }
        }

        $DriverPaymentMethod = DriverPaymentMethod::where('driver_id', $user->id)->first();

        $data = [
            'status' => true,
            'message' => 'Driver Payment Method Send Successfully!',
            'data' => $DriverPaymentMethod,
        ];
        return response()->json($data, 200);
    }

    public function getLocalTime(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        if ($request->isMethod('POST')) {
            return response()->json([
                'status' => false,
                'message' => 'Accept Only GET request!',
            ], 400);
        }

        $time = Time::where('status', '1')->orderBy('id', 'DESC')->get(['id', 'time']);
        return response()->json([
            'status' => true,
            'message' => 'Data Sennd Successfully!',
            'data' => $time,
        ], 200);
    }
    public function sendStartRideOtp(Request $request)
    {
        if (!$request->isMethod('POST')) {
            return response()->json([
                'status' => false,
                'message' => 'Accept Only POST request!',
            ], 400);
        }

        // Authenticate user
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!',
            ], 401);
        }

        try {
            $validator = Validator::make($request->all(), [
                'booking_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ], 422);
            }

            // dd($user);

            $check_order = AssignBooking::where([
                'driver_id' => $user->id,
                'booking_id' => $request->booking_id
            ])->first();

            if (!$check_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Booking Id',
                ], 400);
            }

            // $otp = rand(1000, 9999);
            $otp = '1234';
            StartRideOtp::updateOrCreate(
                [
                    'driver_id' => $user->id,
                    'booking_id' => $request->booking_id,
                ],
                [
                    'driver_id' => $user->id,
                    'booking_id' => $request->booking_id,
                    'otp' => $otp,
                    'expire_on' => now()->addMinutes(10), // OTP expires in 10 minutes
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully!',
                'otp' => $otp,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!' . $th->getMessage(),
            ], 400);
        }
    }

    public function verifyStartRideOtp(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ], 422);
        }

        try {
            $checkBooking = cabBooking::where('id', $request->booking_id)->first();
            if ($checkBooking->is_driver_createBooking == '0') {
                //this booking is not from driver side 
                $check = StartRideOtp::where([
                    'driver_id' => $user->id,
                    'booking_id' => $request->booking_id,
                    'otp' => $request->otp,
                ])
                    ->where('expire_on', '>=', Carbon::now()) // Ensure OTP is still valid
                    ->first();



                if (!$check) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid OTP!',
                    ], 200);
                }
            }

            $checkBooking->status = '4';
            $checkBooking->update();

            AssignBooking::where(['driver_id' => $user->id, 'booking_id' => $request->booking_id])->update([
                'status' => '1',
                'start_time' => Carbon::now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'OTP verified successfully!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Somehting went wrong!' . $th->getMessage(),
            ], 500);
        }
    }

    public function rideEnd(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();
            $cabBooking = cabBooking::where('id', $request->booking_id)->first();
            $online_amt = $cabBooking->online_payment;
            $offline_amt = $cabBooking->offline_payment;

            $cabBooking->status = '2';
            $cabBooking->save();

            AssignBooking::where('booking_id', $request->booking_id)->update([
                'end_time' => Carbon::now(),
                'online_amount' => $online_amt,
                'offline_amount' => $offline_amt,
                'status' => '2'
            ]);

            DB::commit();


            $user_data['name'] = $cabBooking->name;


            return response()->json([
                'status' => true,
                'message' => 'Ride Completed Successfully!',
                'name' => $cabBooking->name ?? 'New User',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Somehting went wrong!' . $th->getMessage(),
            ], 500);
        }
    }

    public function editComission(Request $request)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ], 422);
        }

        $comission = cabBooking::where('id', $request->booking_id)->first();
        $data = [
            'id' => $comission->id,
            'driver_comission' => $comission->driver_comission,
            'total_faire' => $comission->total_faire,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Comission Send Successfully!',
            'data' => $data,
        ], 200);
    }

    public function updateComission(Request $request)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'comission' => 'required',
            'total_amount' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ], 422);
        }

        cabBooking::where('id', $request->booking_id)->update([
            'driver_comission' => $request->comission,
            'total_faire' => $request->total_amount,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Comission Updated Successfully!',
        ], 200);
    }

    public function checkBankInfo(Request $request)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!'
            ], 401);
        }

        $bankInfo = DriverPaymentMethod::where(['driver_id' => $user->id])->first();

        if (empty($bankInfo)) {
            return response()->json([
                'status' => false,
                'message' => 'Bank Info Not Found!',
                'data' => ''
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Bank Info Send Successfully!',
            'data' => $bankInfo,
        ], 200);
    }

    public function driverRatingReviewList()
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token required!'
                ], 401);
            }

            $bookignRating = BookingRatingReview::where('driver_id', $user->id)
                ->orderBy('id', 'DESC')
                ->get(['id', 'driver_id', 'rating', 'checkBox_review', 'text_review', 'created_at'])
                ->map(function ($item) {
                    $driver = Driver::where('id', $item->driver_id)->first(['name', 'driver_image']);
                    $item->rating_byName = $driver ? $driver->name : null;
                    $item->rating_byImage = $driver ? url('public/uploads/driver_photo/' . $driver->driver_image) : null;

                    return $item;
                });

            return response()->json([
                'status' => true,
                'message' => 'Rating Review List Send Successfully!',
                'data' => $bookignRating,
            ], 200);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'data' => '',
            ], 200);
        }
    }

    private function updateDriverDetails(Request $request, $driverId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'aadhar_no' => 'required|numeric',
            'pan_no' => 'required',
            'dl_no' => 'required',
            'driver_image' => 'nullable|mimes:jpg,jpeg,png,webp,avif',
            'dl_image' => 'nullable|mimes:jpg,jpeg,png,webp,avif',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $driver = Driver::find($driverId);
        if (!$driver) {
            throw new \Exception('Driver not found');
        }

        $driver->fill($request->only([
            'name',
            'email',
            'phone',
            'aadhar_no',
            'pan_no',
            'dl_no'
        ]));

        if ($request->hasFile('driver_image')) {
            $driver->driver_image = $this->commonServices->fileupload($request->file('driver_image'), 'driver_photo');
        }

        if ($request->hasFile('dl_image')) {
            $driver->dl_image = $this->commonServices->fileupload($request->file('dl_image'), 'dl_image');
        }

        $driver->save();
    }

    private function updateCarDetails(Request $request, $driverId)
    {
        $validator = Validator::make($request->all(), [
            // 'driver_id' => 'required|exists:driver,id',
            'car_brand' => 'required',
            'car_name' => 'required',
            'car_no' => 'required',
            'fuel_type' => ['required', 'in:0,1,2,3,4'],
            'no_seat' => 'required|numeric',
            'insurence_expiry' => 'required|date',
            'car_image' => 'nullable|mimes:jpg,jpeg,png,webp,avif',
            'insurence_image' => 'nullable|mimes:jpg,jpeg,png,webp,avif',
            'car_rc_frontImage' => 'nullable|mimes:jpg,jpeg,png,webp,avif',
            'car_rc_backImage' => 'nullable|mimes:jpg,jpeg,png,webp,avif',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $carDetail = DriverCarDetails::where('driver_id', $driverId)->first();
        if (!$carDetail) {
            throw new \Exception('Driver Car Detail not found');
        }

        $carDetail->fill($request->only([
            'car_brand',
            'car_name',
            'car_no',
            'fuel_type',
            'no_seat',
            'insurence_expiry'
        ]));

        if ($request->hasFile('car_image')) {
            $carDetail->car_image = $this->commonServices->fileupload($request->file('car_image'), 'car_image');
        }

        if ($request->hasFile('insurence_image')) {
            $carDetail->insurence_image = $this->commonServices->fileupload($request->file('insurence_image'), 'insurence_photo');
        }

        if ($request->hasFile('car_rc_frontImage')) {
            $carDetail->car_rc_frontImage = $this->commonServices->fileupload($request->file('car_rc_frontImage'), 'carRc_front_image');
        }

        if ($request->hasFile('car_rc_backImage')) {
            $carDetail->car_rc_backImage = $this->commonServices->fileupload($request->file('car_rc_backImage'), 'carRc_back_image');
        }

        $carDetail->save();
    }

    //======================== Create razorpay orderId ======================//
    public function create_razorpay_order($amount)
    {
        $ch = curl_init();
        $fields = array();
        $fields['amount'] = $amount * 100;
        $fields["currency"] = "INR";
        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "rzp_test_2APbUBB8GPokeh:6FceULs86B016CJ9wIeo4fov");
        // curl_setopt($ch, CURLOPT_USERPWD, "rzp_live_arOvA4NT5RSyKm:LHtaJhMeoCjWVabNuS4PUifQ");
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        if (empty($data) or (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
            return json_decode($data, FALSE);
        } else {
            return json_decode($data, TRUE);
        }
    }



    public function authMessage()
    {
        return response()->json([
            'status' => false,
            'message' => 'Token required!'
        ], 401);
    }
}
