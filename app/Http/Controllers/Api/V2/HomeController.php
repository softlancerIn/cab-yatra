<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BookingResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Services\V2\CommonServices;
use Illuminate\Http\Request;


use App\Models\{
    Driver,
    AppBanner,
    cabBooking,
    AssignBooking,
    BookingRatingReview,
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

    // public function home(Request $request)
    // {
    //     $user = auth('sanctum')->user();

    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Token required!'
    //         ], 401);
    //     }

    //     $page = $request->get('page', 1);

    //     $cacheKey = "home_response_driver_{$user->id}_page_{$page}";

    //     return Cache::tags([
    //         'home',
    //         'driver_' . $user->id
    //     ])
    //         ->remember($cacheKey, now()->addMinutes(5), function () use ($user) {

    //             $app_banner = AppBanner::where('status', '1')
    //                 ->get(['id', 'name', 'image', 'url']);

    //             $new_booking = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])
    //                 ->where([
    //                     'is_assigned' => '1',
    //                     'is_driver_accepted' => '0'
    //                 ])
    //                 ->orderByDesc('id')
    //                 ->paginate(10);

    //             $active_booking_ids = AssignBooking::where('driver_id', $user->id)
    //                 ->pluck('booking_id')
    //                 ->toArray();

    //             $active_booking = empty($active_booking_ids)
    //                 ? collect()
    //                 : cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])
    //                 ->whereIn('id', $active_booking_ids)
    //                 ->where('status', '!=', '0')
    //                 ->paginate(10);

    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data Send Successfully!',
    //                 'banners' => $app_banner,
    //                 'new_booking' => BookingResource::collection($new_booking)->response()->getData(true),
    //                 'active_booking' => BookingResource::collection($active_booking)->response()->getData(true),
    //             ]);
    //         });
    // }

    public function home(Request $request)
    {
        $user = $this->sanctumUser();

        $app_banner = AppBanner::where('status', '1')
            ->get(['id', 'name', 'image', 'url']);

        $new_booking = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])
            ->where([
                'is_assigned' => '1',
                'is_driver_accepted' => '0'
            ])
            ->orderByDesc('id')
            ->paginate(10);

        $active_booking_ids = AssignBooking::where('driver_id', $user->id)
            ->orderByDesc('id')
            ->pluck('booking_id')
            ->toArray();

        $active_booking = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])
            ->where('is_assigned', '1')
            ->where('status', '!=', '0')
            ->whereIn('id', $active_booking_ids)
            ->orderByRaw("FIELD(id, " . implode(',', $active_booking_ids) . ")")
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Data Send Successfully!',
            'banners' => $app_banner,
            'new_booking' => BookingResource::collection($new_booking)->response()->getData(true),
            'active_booking' => BookingResource::collection($active_booking)->response()->getData(true),
        ], 200);
    }


    private function getDriverRating($driverId)
    {
        $rating = BookingRatingReview::where('driver_id', $driverId)->avg('rating');
        return number_format($rating, 1);
    }

    public function getFilters(Request $request)
    {
        $user = $this->sanctumUser();

        $vehicles = $this->commonServices->getDriverVehicles($user->id);

        return response()->json([
            'status' => true,
            'message' => 'Vehicles fetched successfully',
            'data' => ['Vehicles' => $vehicles],
        ], 200);
    }
    
    public function filter(Request $request)
    {
        $user = $this->sanctumUser();

        $query = cabBooking::with(['carCategory', 'car', 'timeSchadule_data'])
            ->where([
                'is_assigned' => '1',
                'is_driver_accepted' => '0'
            ]);

        if ($request->filled('vehicle_id')) {
            $query->whereHas('car', function ($q) use ($request) {
                $q->where('id', $request->vehicle_id);
            });
        }

        if ($request->filled('pickup_location')) {
            $query->where('pickUpLoc', 'like', '%' . $request->pickup_location . '%');
        }

        if ($request->filled('drop_location')) {
            $query->where('destinationLoc', 'like', '%' . $request->drop_location . '%');
        }

        $data = $query->orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Filtered bookings fetched successfully',
            'data' => $data,
        ], 200);
    }
}
