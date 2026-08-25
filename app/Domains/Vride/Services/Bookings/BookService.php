<?php 

namespace App\Domains\Vride\Services\Bookings;

use App\Domains\Delivery\Models\Trip;
use App\Http\Responses\ApiResponse;
use App\Domains\Delivery\Models\Booking;

class BookService 
{
    public function run($data) 
    {
        $trip = Trip::lockForUpdate()->find($data->id);

        if ($trip->available_seats < $data->seats) {
            return ApiResponse::error(message: "Not enough seats available");
        }

        $booking = Booking::create([
            'trip_id' => $trip->id,
            'passenger_id' => $data->user()->id,
            'seats' => $data->seats,
            'amount' => $data->amount,
            'status' => 'pending',
        ]);

        $trip->decrement('available_seats', $data->seats);

        return ApiResponse::success(data: $booking, message: "Trip booked successfully");
    }
}