<?php

namespace App\Http\Requests\Doorway;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name'  => ['required', 'string', 'min:2', 'max:255',],
            'email' => ['required', 'unique:users,email', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'device_name' => ['required', 'string', 'max:255',]
        ];
    }
}
