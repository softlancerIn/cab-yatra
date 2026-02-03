<?php

namespace App\Http\Requests\V2;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type' => 'required|in:0,1',
        ];

        if ($this->type == 0) {
            $rules += [
                'upi_id' => 'nullable|string|max:255',
                'payment_number' => 'nullable|string|max:20',
                'qr_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ];
        }

        if ($this->type == 1) {
            $rules += [
                'bank_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:50',
                'ifsc_code' => 'required|string|max:20',
                'account_holderName' => 'required|string|max:255',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Payment type is required',
            'type.in' => 'Invalid payment type',
        ];
    }
}
