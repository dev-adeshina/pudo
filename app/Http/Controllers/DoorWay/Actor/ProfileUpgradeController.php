<?php

namespace App\Http\Controllers\DoorWay\Actor;


use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Actor\ProfileUpgradeRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;

class ProfileUpgradeController extends Controller
{
    //
    public function upgrade(ProfileUpgradeRequest $request): JsonResponse
    {

        $user = $request->user();
        $data = $request->validated();

        if (! $this->hasPersonalprofile($user)) {
            return ApiResponse::forbidden(message: "Please get your personal profile intact first.");
        }

        try{
            $actor = DB::transaction(function () use($user, $data) {
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

                $pudo->actor()->create([
                    'user_id'       => $user['id'],
                    'actor'         =>  'ACT'. str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
                    'type'          => $data['type'],
                    'status' => StatusEnum::PENDING
                ]);
            });
             return ApiResponse::success($actor);
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
