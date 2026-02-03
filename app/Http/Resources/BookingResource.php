<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = auth('sanctum')->user();

        return [
            'bookingId' => $this->orderId,
            'pickup_date' => $this->pickUp_date,
            'pickup_time' => $this->pickUp_time,

            'booking_type' => $this->subType == '1' ? 'One Way' : 'Round Trip',

            'pickup_location' => $this->getLocationValue($this->pickUpLoc),
            'destination_location' => $this->getLocationValue($this->destinationLoc),

            'car_image' => $this->car->image ?? null,
            'car_category_name' => $this->carCategory->name ?? null,

            'remark' => $this->remark,
            'total_fare' => $this->total_faire,
            'driver_commission' => $this->driverCommission,
            'is_show_phone_number' => $this->is_show_phoneNumber,

            'driver_number' => (
                $this->is_driver_createBooking == '1' &&
                $this->is_show_phoneNumber == '1'
            ) ? $user?->phone : null,
        ];
    }

    private function getLocationValue($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);

            // If it's valid JSON array, return first item
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded[0] ?? null;
            }

            // Otherwise, return the original string
            return $value;
        }

        return $value;
    }
}
