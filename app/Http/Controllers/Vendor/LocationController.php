<?php

namespace App\Http\Controllers\Vendor;

use App\Domains\Identity\Models\Vendor;
use App\Domains\Identity\Models\VendorLocation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\LocationListRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class LocationController extends Controller
{

    public function show(Request $request): JsonResponse 
    {
        $user = $request->user();

        $location = VendorLocation::where('vendor_id', $user->vendor->id)->first();
        if(!$location) {
            return ApiResponse::notFound();
        }
        return ApiResponse::success($location);
    }


    public function store(LocationListRequest $request): JsonResponse
    {
        $user = $request->user();

        if(!$user->vendor->id) {
            return ApiResponse::error('Sorry!, you have not listed your business');
        }

        $location = VendorLocation::create([
            'vendor_id'     => $user->vendor->id,
            'label'         => $request->label,
            'address_line'  => $request->address_line,
            'city'          => $request->city,
            'state'         => $request->state,
            'country_code'  => $request->country_code,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude
        ]);

        return ApiResponse::success($location, 'You have successfully listed your location');
    }
}
