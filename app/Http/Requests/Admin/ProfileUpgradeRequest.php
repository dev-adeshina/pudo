<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Enums\Admin\RoleEnum;
use App\Enums\Admin\DepartmentEnum;

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
            'user_id' => ['required', 'integer', 'exists:users,id', Rule::unique('admins', 'user_id'), Rule::unique('admin_profiles', 'user_id')],
            'role'  => ['required', 'string', Rule::enum(RoleEnum::class)],
            'department' => ['required', 'string', Rule::enum(DepartmentEnum::class)]
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.unique' => 'You have already submitted your personal profile.',
        ];
    }
}

