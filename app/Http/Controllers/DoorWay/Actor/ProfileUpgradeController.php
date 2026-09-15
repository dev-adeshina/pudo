<?php

namespace App\Http\Controllers\DoorWay\Actor;


use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Actor\ProfileUpgradeRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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
