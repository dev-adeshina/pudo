<?php

namespace App\Http\Requests\Vride;

use App\Domains\Vride\Enums\Books\BoardType;
use App\Domains\Vride\Enums\Books\DistanceType;
use App\Domains\Vride\Enums\Books\VehicleType;
use App\Domains\Vride\Enums\BookType;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'ride_type'      => ['required', Rule::enum(VehicleType::class)],
            'trip_id'   => ['required', 'integer'],
            'passenger_id'   => ['required', Rule::unique(User::class, 'id')],
            'board_type'      => ['required', Rule::enum(BoardType::class)],
            'seats'   => ['required', 'integer'],
            'distance_type'      => ['required', Rule::enum(DistanceType::class)],
            'pickup_location'   => ['required', 'string'],
            'pickup_latitude'   => ['required', 'integer'],
            'pickup_longitude'   => ['required', 'integer'],
            'dropoff_location'   => ['required', 'string'],
            'dropoff_latitude'   => ['required', 'integer'],
            'dropoff_longitude'   => ['required', 'integer'],
            'amount'   => ['required', 'integer'],
            'currency'   => ['required', 'integer'],

        ];
    }
}



