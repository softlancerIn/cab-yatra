<?php

namespace App\Http\Requests\V2;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type' => 'required|in:0,1', // 0 = UPI, 1 = Bank
        ];

        if ($this->type == 0) {
            // UPI
            $rules += [
                'upi_id' => 'nullable|string|max:255',
                'payment_number' => 'nullable|string|max:20',
                'qr_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ];
        }

        if ($this->type == 1) {
            // Bank
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

            'bank_name.required' => 'Bank name is required',
            'account_number.required' => 'Account number is required',
            'ifsc_code.required' => 'IFSC code is required',
            'account_holderName.required' => 'Account holder name is required',

            'qr_image.image' => 'QR must be an image',
            'qr_image.mimes' => 'QR image must be jpg or png',
        ];
    }
}
