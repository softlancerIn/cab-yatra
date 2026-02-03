<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'uniqId'                => $this->uniqId,
            'name'                  => $this->name,
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'city'                  => $this->city,
            'type'                  => $this->type,
            'license_number'        => $this->license_number,
            'status'                => (string) $this->status,
            'rating'                => (string) ($this->rating ?? 0),
            'driver_image_url'      => $this->imageUrl('driver_photo', $this->driver_image),
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }

    private function imageUrl(string $folder, ?string $image): ?string
    {
        return $image
            ? url("public/uploads/{$folder}/{$image}")
            : null;
    }
}
