<?php

namespace App\Http\Requests\Errand;

use App\Enums\StatusEnum;
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
            'user_id' => ['required', 'integer', 'exists:users,id', Rule::unique('pudos', 'user_id'), Rule::unique('errands', 'user_id'), Rule::unique('errand_profiles', 'errand_id')],
            'type' => ['required', 'string', 'exists:errand_types,name'],
            'residential_address' => ['required', 'string', 'max:500'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_mobile' => ['required', 'string', 'max:30'],
            'availability' => ['required', 'string', 'max:255'],
            'contact_verification' => ['required', 'string', Rule::enum(StatusEnum::class)],
            'skill' => ['nullable', 'string', 'max:255', Rule::requiredIf(fn () => $this->input('type') === 'Skilled'), Rule::exists('skills', 'name')],
        ];
    }
}
