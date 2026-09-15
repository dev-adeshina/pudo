<?php

namespace App\Http\Requests\Vride;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;




class ProfileUpgradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id', Rule::unique('pudos', 'user_id'), Rule::unique('v_rides', 'user_id'), Rule::unique('v_ride_profiles', 'user_id')],
            'bio'                       => ['required', 'string', 'max:255'],
            'years_of_experience'       => ['required', 'string', 'max:255'],
            'residential_address'       => ['required', 'string', 'max:255'],
            'emergency_contact_name'    => ['required', 'string', 'max:255'],
            'emergency_contact_phone'   => ['required', 'string', 'max:255']
        ];
    }
}
