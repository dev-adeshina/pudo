<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\Kyc\KycStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Domains\Kyc\contracts\kycable;
use Symfony\Component\HttpFoundation\Response;





class KycAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $status, int $requiredLevel = 1): Response
    {

        if (! $request->user()) {
            abort(401);
        }

        $user = $request->user();

        abort_unless($user, 401);

        $accessType = $user->accessTypes()->where('is_active', true)->with('accessable')->first();

        if (! $accessType) {
            return ApiResponse::forbidden(
                message: 'No active access type.'
            );
        }

        $segment = $accessType->accessable;

        if (! $segment instanceof Kycable) {
            return ApiResponse::forbidden(
                message: 'KYC is not required for this segment.'
            );
        }

        $kyc = $segment->kyc;

        if (! $kyc) {
            return ApiResponse::forbidden(
                message: 'KYC verification required.'
            );
        }


        if ($kyc->status !== KycStatus::VERIFIED) {
            return ApiResponse::forbidden(
                message: 'KYC verification required.'
            );
        }

        if ($kyc->current_level < $requiredLevel) {
            return ApiResponse::forbidden(
                message: "KYC level {$requiredLevel} required."
            );
        }

        return $next($request);
    }
}
