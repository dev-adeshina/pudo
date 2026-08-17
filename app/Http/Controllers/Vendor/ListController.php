<?php

namespace App\Http\Controllers\Vendor;

use App\Domains\Identity\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\BusinessListingRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListController extends Controller
{
    //

    public function show(Request $request): JsonResponse 
    {
        $user = $request->user();
        $vendor = Vendor::where('user_id', $user->id)->first();
        if(!$vendor) {
            return ApiResponse::notFound();
        }
        return ApiResponse::success($vendor);
    }

    public function store(BusinessListingRequest $request): JsonResponse
    {

        $user = $request->user();

        $vendor = Vendor::create([
            'user_id'           =>  $user->id,
            'profile_type_id'   =>  $request->profile_type_id,
            'business_name'     =>  $request->business_name,
            'slug'              =>  Str::slug($request->business_name),
            'status'            =>  'pending'

        ]);

        if(!$vendor) 
            return ApiResponse::error('Something happened, please try again later');
        return ApiResponse::success($vendor, 'Successfully created your business');
    }
}
