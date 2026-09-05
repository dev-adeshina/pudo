<?php

namespace App\Http\Requests\Doorway;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\GenderEnum;
use Illuminate\Support\Facades\Auth;

class PersonalProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
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
            'user_id' => ['required', 'integer', 'exists:users,id', 'unique:personal_profiles,user_id'],
            'gender' => ['required', 'string', 'max:255', Rule::enum(GenderEnum::class)],
            'dob' => ['required', 'date'],
            'profile_photo_path' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.unique' => 'You have already submitted your personal profile.',
        ];
    }
}
