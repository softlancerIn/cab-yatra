<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\CommonServices;
use Illuminate\Http\Request;
use App\Traits\SanctumAuthTrait;
use App\Http\Requests\Admin\V2\ProfileRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProfileResource;

use App\Models\{
    Driver,
    BookingRatingReview,
};

class ProfileController extends Controller
{
    use SanctumAuthTrait;

    public function __construct(public CommonServices $commonServices) {}

    public function profile(ProfileRequest $request)
    {
        $user = $this->sanctumUser();
        $driver = Driver::findOrFail($user->id);

        if ($request->isMethod('get')) {
            $driver->rating = $this->commonServices->calculateDriverRating($user->id);

            return response()->json([
                'status'  => true,
                'message' => 'Profile data fetched successfully',
                'data'    => new ProfileResource($driver),
            ]);
        }

        DB::beginTransaction();

        try {
            $this->updateDriverDetails($request, $driver);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Profile updated successfully',
                'data'    => new ProfileResource($driver->fresh()),
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            \Log::error('Profile update failed', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'An error occurred while updating profile',
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

    
    public function reviews(Request $request)
    {
        $user = $this->sanctumUser();

        $reviews = BookingRatingReview::where('driver_id', $user->id)
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
            'message' => 'Reviews fetched successfully',
            'data' => $reviews,
        ], 200);
    }
}