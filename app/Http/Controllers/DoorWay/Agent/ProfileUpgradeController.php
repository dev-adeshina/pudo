<?php

namespace App\Http\Controllers\DoorWay\Agent;


use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\ProfileUpgradeRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;


class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if (! $this->hasPersonalprofile($user)) {
            return ApiResponse::forbidden(message: "Please get your personal profile intact first.");
        }

        try{
            $agent = DB::transaction(function () use($user, $data) {
                $pudo = Pudo::create([
                    'user_id' => $user->id,
                    'type' => 'AGENT'
                ]);

                $accesspoint = $user->accessPoint()->firstOrFail();
                $pudo->accessType()->create([
                    'access_point_id'   => $accesspoint->id,
                    'user_id'           => $user->id,
                    'is_active'         => true
                ]);

                $pudo->agent()->create([
                    'user_id'       => $user['id'],
                    'agent_code'    => 'AGN'. str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
                    'type'          => $data['type'],
                    'status' => StatusEnum::PENDING
                ]);

            });

            return ApiResponse::success($agent);
        }catch(Throwable $e){
            report($e);
            return ApiResponse::error($e);
        }

       
    }

    public function hasPersonalprofile(User $user): bool
    {
        return $user->personalprofile()->exists();
    }
}



