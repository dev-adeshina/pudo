<?php

namespace App\Http\Controllers\DoorWay\Profile;

use App\Domains\Identity\Models\ProfileType;
use App\Domains\Identity\Models\UserExtend;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doorway\GeneralProfileRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralProfileController extends Controller
{
    public function __invoke(GeneralProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $profile = ProfileType::create([
            'name' => $request->name,
            'slug' => $request->name,
            'status' => 'active'
        ]);

        $extend = $profile->userExtends()->create([
            'user_id' =>$user->id,
            'code' => '4544',
            'status' => 'pending'
        ]);
    
        return ApiResponse::success($extend);
    }
}
