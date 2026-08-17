<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LocationListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:255'],
            'address_line'=> ['required', 'string', 'max:255'],
            'city'=> ['required', 'string', 'max:255'],
            'state'=> ['required', 'string', 'max:255'],
            'country_code'=> ['required', 'string', 'max:255'],
            'latitude'=> ['required', 'string', 'max:255'],
            'longitude'=> ['required', 'string', 'max:255'],
        ];
    }
}


