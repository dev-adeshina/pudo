<?php

namespace App\Http\Requests\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Enums\CurrencyEnum;
use App\Enums\LanguageEnum;

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
            'user_id' => ['required', 'integer', 'exists:users,id', Rule::unique('clients', 'user_id'), Rule::unique('client_profiles', 'user_id')],
            'preferred_currency' => ['required', 'string', Rule::enum(CurrencyEnum::class)],
            'preferred_language' => ['required', 'string', Rule::enum(LanguageEnum::class)],
        ];
    }
}
