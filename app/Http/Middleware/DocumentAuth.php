<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class DocumentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $status): Response
    {
        if (! $request->user()) {
            abort(401);
        }

        if ($request->user()->kyc?->status !== $status) {
            return ApiResponse::forbidden(message: "Please complete your step two verification upgrade");
        }
        return $next($request);
    }
}
