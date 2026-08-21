<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class AccessPoint
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $access): JsonResponse
    {
        if (! $request->user()) {
            abort(401);
        }

        if ($request->user()->accessPoint?->slug !== $access) {
            return $this->switchRoute($request->user()->accessPoint?->slug);
            
        }
        return $next($request);
    }


    public function switchRoute(string $access)
    {
        switch ($access) {
             case 'admin':
                 return ApiResponse::forbidden(message: "You are not an admin");
                break;
            case 'user':
                 return ApiResponse::forbidden(message: "You are not an user");
                break;
            case 'pudo':
                 return ApiResponse::forbidden(message: "You are not an pudo");
                break;
            case 'skilled':
                 return ApiResponse::forbidden(message: "You are not an skilled errand");
                break;
            case 'delivery':
                 return ApiResponse::forbidden(message: "You are not an delivery man");
                break;
            case 'errand':
                 return ApiResponse::forbidden(message: "You are not an errand");
                break;
            return ApiResponse::forbidden(message: "You have no access here");
        }
    }
}



