<?php

namespace App\Http\Requests\Vride;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Domains\Vride\Enums\TripTypes;

class TripRequest extends FormRequest
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
            'type' => ['required', Rule::enum(TripTypes::class)],
            'allocated_time' => ['required', 'date'],
            'departure' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'number_of_seats' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }
}
