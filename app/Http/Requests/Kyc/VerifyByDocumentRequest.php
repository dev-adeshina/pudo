<?php

namespace App\Http\Requests\Kyc;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\Kyc\KycDocumentType;
use Illuminate\Validation\Rule;

class VerifyByDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'type' => ['required',  Rule::enum(KycDocumentType::class),],
            'document_number' => ['required', 'string', 'max:100',],
            'surname' => ['nullable', 'string', 'max:100', 'required_if:type,' . KycDocumentType::PASSPORT->value,],
            'file' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png', 'max:5120',],
        ];
    }
}
