<?php

namespace App\Http\Requests\Admin\V2;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                // 'user_id' => 'required|integer|exists:driver,id',
                'subType' => 'required|integer',
                'carCategoryId' => 'required|integer|exists:car_category,id',
                'pickUp_date' => 'required|date',
                'pickUp_time' => 'required',
                'pickUpLoc' => 'required',
                'destinationLoc' => 'required',
                'total_faire' => 'required|numeric|min:0',
                'driverCommission' => 'required|numeric|min:0',
                'is_show_phoneNumber' => 'required|boolean',
                'remarks' => 'nullable|string|max:500',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'pickUp_date' => 'sometimes|required|date',
                'pickUp_time' => 'sometimes|required',
                'pickUpLoc' => 'sometimes|required',
                'destinationLoc' => 'sometimes|required',
                'total_faire' => 'sometimes|required|numeric|min:0',
                'driverCommission' => 'sometimes|required|numeric|min:0',
                'is_show_phoneNumber' => 'sometimes|required|boolean',
                'remarks' => 'sometimes|nullable|string|max:500',
            ];
        }

        return [];
    }

    // Add custom error messages here
    public function messages(): array
    {
        return [
            // 'user_id.required' => 'Driver ID is required.',
            'user_id.integer' => 'Driver ID must be a number.',
            'user_id.exists' => 'The selected driver does not exist.',
            'subType.required' => 'Booking subtype is required.',
            'subType.integer' => 'Booking subtype must be a number.',
            'carCategoryId.required' => 'Car category is required.',
            'carCategoryId.exists' => 'Selected car category does not exist.',
            'pickUp_date.required' => 'Pickup date is required.',
            'pickUp_date.date' => 'Pickup date must be a valid date.',
            'pickUp_time.required' => 'Pickup time is required.',
            'pickUpLoc.required' => 'Pickup location is required.',
            'destinationLoc.required' => 'Destination location is required.',
            'total_faire.required' => 'Total fare is required.',
            'total_faire.numeric' => 'Total fare must be a number.',
            'driverCommission.required' => 'Driver commission is required.',
            'driverCommission.numeric' => 'Driver commission must be a number.',
            'is_show_phoneNumber.required' => 'You must specify if the driver can see the phone number.',
            'is_show_phoneNumber.boolean' => 'Phone number visibility must be true or false.',
            'remarks.max' => 'Remarks cannot exceed 500 characters.',
        ];
    }

    // Optional: customize response format for API
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
