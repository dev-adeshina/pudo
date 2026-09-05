<?php

namespace App\Http\Controllers\DoorWay\Profile;

use App\Domains\Identity\Models\PersonalProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doorway\PersonalProfileRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
class GeneralProfileController extends Controller
{
    public function __invoke(PersonalProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $profile = $user->personalProfile()->create([
            'gender' => $request->gender,
            'dob' => $request->dob,
            'profile_photo_path' => $request->profile_photo_path ?? "we are yet to work on this",
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country
        ]);    
        return ApiResponse::success($profile);
    }
}
