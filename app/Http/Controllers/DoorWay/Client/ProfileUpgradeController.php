<?php

namespace App\Http\Controllers\DoorWay\Client;

use App\Domains\Identity\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use App\Http\Requests\Client\ProfileUpgradeRequest;
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
            $client = DB::transaction(function () use ($user, $data) {
                $client = Client::create([
                    'user_id' => $user->id,
                    'code' => 'CLI-' . strtoupper(uniqid()),
                    'status' => StatusEnum::PENDING
                ]);

                $accesspoint = $user->accessPoint()->firstOrFail();
                $client->accessType()->create([
                    'access_point_id'   => $accesspoint->id,
                    'user_id'           => $user->id,
                    'is_active'         => true
                ]);

                $client->profile()->create([
                    'preferred_currency' => $data['preferred_currency'],
                    'preferred_language' => $data['preferred_language']
                ]);

                return $client;
            });

            return ApiResponse::success($client);
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
