<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delievery\NearByRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Domains\Fulfilment\Delivery\Models\Delivery;




class NearestRideController extends Controller
{
    //

    public function searchNearBy(NearByRequest $request): JsonResponse
    {
       
        $passenger = $request->user();

        $pickupLatitude = $request->pickup_latitude;
        $pickupLongitude = $request->pickup_longitude;

        $nearbyDrivers = Redis::geosearch(
            'drivers',
            $pickupLongitude,
            $pickupLatitude,
             5,
            'km',
            'ASC',
            null,
            true,
            true
        );

        $availableDrivers = Redis::smembers(
            'drivers:available'
        );

        $availableDrivers = array_flip(
            $availableDrivers
        );

        $drivers = collect($nearbyDrivers)
            ->filter(function ($driver) use ($availableDrivers) {

                $driverId = $driver[0];

                return isset(
                    $availableDrivers[$driverId]
                );
            })
            ->values();


        if ($drivers->isEmpty()) {

            return ApiResponse::notFound('No nearby driver available');
        }

        $nearestDriver = $drivers->first();

        $driverId = $nearestDriver[0];

        $distance = $nearestDriver[1];


        $ride = Delivery::create([

            'passenger_id' => $passenger->id,

            'driver_id' => null,

            'pickup_latitude' => $pickupLatitude,

            'pickup_longitude' => $pickupLongitude,

            'destination_latitude' =>
                $request->destination_latitude,

            'destination_longitude' =>
                $request->destination_longitude,

            'status' => 'searching',
        ]);

        Redis::setex(
            "ride:{$ride->id}:driver",
            30,
            $driverId
        );

        return ApiResponse::success([
            'nearby_drivers' => $nearbyDrivers,
            'ride' => $ride,
            'driver_id' => $driverId,
            'distance' => $distance,
        ]);
    }

    public function markAvailable(int $driverId): void
    {
        Redis::sadd(
            'drivers:available',
            $driverId
        );
    }

    public function markUnavailable(int $driverId): void
    {
        Redis::srem(
            'drivers:available',
            $driverId
        );
    }
}
