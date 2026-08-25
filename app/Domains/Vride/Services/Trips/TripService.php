<?php

namespace App\Domains\Vride\Services\Trips;

use App\Domains\Vride\Enums\TripTypes;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Domains\Delivery\Models\Trip;

class TripService
{
    public function run($data): JsonResponse
    {
        $driver  = $data->user()->vride->id;

        $location = Redis::geopos('drivers', $driver->id);

        if (empty($location) || empty($location[0]))
            return ApiResponse::notFound(message: "Your current is unavailable");

        $longitude  = $location[0][0];
        $latitude   = $location[0][1];

        $trip = Trip::create([
            'v_ride_id'      => $driver->vride->id,
            'type'          => $data->type,
            'available_at'  => $data->allocated_time,
            'departure'     => $data->departure,
            'destination'   => $data->destination,
            'start_latitude'    => $latitude,
            'start_longitude'   => $longitude,
            'seats_available'   => $data->number_of_seats,
            'status' => 'available',
        ]);

        return ApiResponse::success(data: [
            'trip' => $trip, 
            'current_location' => [
                'latitude' => $latitude, 
                'longitude' => $longitude
                ]
            ], message: "Trip created Successfully");
    }
}
