<?php

namespace App\Http\Controllers\DoorWay\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProfileUpgradeRequest;
use App\Domains\Identity\Models\AdminProfile;
use App\Domains\Identity\Models\Admin;
use App\Enums\StatusEnum;
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
            $admin = DB::transaction(function () use($user, $data) {
                $admin = Admin::create([
                    'user_id' => $user->id,
                    'code' => 'ADM-' . strtoupper(uniqid()),
                    'status' => StatusEnum::PENDING
                ]);

                $accesspoint = $user->accessPoint()->firstOrFail();
                $admin->accessType()->create([
                    'access_point_id'   => $accesspoint->id,
                    'user_id'           => $user->id,
                    'is_active'         => true
                ]);

                $admin->profile()->create([
                    'role' => $data['role'],
                    'department' => $data['department']
                ]);

                return $admin;
            });

            return ApiResponse::success($admin);

        } catch(Throwable $e) {
            report($e);
            return ApiResponse::error(message: 'Unable to upgrade your profile at this time.');
        }

    }

    public function hasPersonalprofile(User $user): bool
    {
        return $user->personalprofile()->exists();
    }
}


