<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'uniqId'                => $this->uniqId,
            'amount'                => $this->amount,
            'payment_method'        => $this->payment_method,
            'status'                => (string) $this->status,
            'transaction_date'      => $this->transaction_date,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
