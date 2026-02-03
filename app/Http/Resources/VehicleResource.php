<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'uniqId'        => $this->uniqId,
            'make'          => $this->make,
            'model'         => $this->model,
            'year'          => $this->year,
            'license_plate' => $this->license_plate,
            'color'         => $this->color,
            'status'        => (string) $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
