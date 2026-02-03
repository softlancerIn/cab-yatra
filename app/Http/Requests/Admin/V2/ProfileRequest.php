<?php

namespace App\Http\Requests\Admin\V2;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:agent,owner,driver',
            'license_number' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Name is required',
            'type.required'  => 'Driver type is required',
            'type.in'        => 'Invalid driver type',
        ];
    }
}
