<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'user_id' => Auth::id(),
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
            'user_id' => ['required', 'integer', 'exists:users,id', Rule::unique('pudos', 'user_id'), Rule::unique('vendors', 'user_id'), Rule::unique('vendor_profiles', 'user_id')],
            'business_name' => ['required', 'string', 'max:255'],
            'business_mobile'    => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('vendors', 'slug')],
            'logo' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'operating_hours' => ['required', 'string'],
        ];
    }
}
