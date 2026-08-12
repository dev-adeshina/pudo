<?php

namespace App\Http\Controllers\DoorWay;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;



class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request): JsonResponse
    {
       $request->fulfill();
       return ApiResponse::success(message: 'Email verified successfully');
    }

    public function show(Request $request): JsonResponse
    {
        return ApiResponse::success(message: 'Your email address must be verified.', data: ['verified' => $request->user()->hasVerifiedEmail()]);
    }

    public function resend(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ApiResponse::success(message: 'Email already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        return ApiResponse::success(message: 'Verification link sent!');
    }
}
