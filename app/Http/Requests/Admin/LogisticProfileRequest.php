<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LogisticProfileRequest extends FormRequest
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
            'name'  => ['required', 'string', 'max:255', Rule::unique('logistics_profiles', 'name')],
            'description' => ['required', 'string'],
            'default_weight_class_id' => ['required', 'integer', 'exists:weight_classes,id'],
            'default_size_class_id' => ['required', 'integer', 'exists:size_classes,id']
        ];
    }
}
