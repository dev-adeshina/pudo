<?php

namespace App\Http\Controllers\DoorWay\Vendor;

use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Vendor\ProfileUpgradeRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if (! $this->hasPersonalprofile($user)) {
            return ApiResponse::forbidden(message: "Please get your personal profile intact first.");
        }

        try {
            $pudo = DB::transaction(function () use ($user, $data) {
                $pudo = Pudo::create([
                    'user_id' => $user->id,
                    'type' => 'VENDOR'
                ]);

                $accesspoint = $user->accessPoint()->firstOrFail();
                $pudo->accessType()->create([
                    'access_point_id'   => $accesspoint->id,
                    'user_id'           => $user->id,
                    'is_active'         => true
                ]);

                $pudo->vendor()->create([
                    'business_name' => $data['business_name'],
                    'business_mobile' => $data['business_mobile'],
                    'business_description'  => $data['description'],
                    'slug' => $data['slug'],
                    'status' => StatusEnum::PENDING
                ]);
                $pudo->vendor->profile()->create([
                    'logo' => $data['logo'] ?? "we are yet to complete this",
                    'description' => $data['description'],
                    'operating_hours' => $data['operating_hours']
                ]);
            });

            return ApiResponse::success($pudo);
        } catch (Throwable $e) {
            report($e);
            return ApiResponse::error(message: 'Unable to upgrade your profile at this time.');
        }

    }

    public function hasPersonalprofile(User $user): bool
    {
        return $user->personalprofile()->exists();
    }
}
