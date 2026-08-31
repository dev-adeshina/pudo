<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;



class ApiResponse
{
    public static function success(
        mixed $data = null, 
        string $message = "Request Successfull", 
        int $statusCode = 200, 
        array $meta = []): JsonResponse
    {
        return self::response(
            success: true,
            message: $message,
            data: $data,
            meta:  $meta,
            statusCode: $statusCode
        );
          
        
    }


    public static function error(
        mixed $data = null, 
        string $message = "Request failed", 
        int $statusCode = 400, 
        array $meta = []): JsonResponse
    {
        return self::response(
            success: false,
            message: $message,
            data: $data,
            meta:  $meta,
            statusCode: $statusCode
        );
    }


    public static function notFound(
        mixed $data = null, 
        string $message = "Resource not found", 
        int $statusCode = 404, 
        array $meta = []): JsonResponse
    {
         return self::error(
            data: $data,
            message: $message,
            meta:  $meta,
            statusCode: $statusCode
         );
    }


    public static function unauthorized(
        mixed $data = null, 
        string $message = "Unauthorized Request", 
        int $statusCode = 401, 
        array $meta = []): JsonResponse
    {
         return self::error(
            data: $data,
            message: $message,
            meta:  $meta,
            statusCode: $statusCode
         );
    }

    public static function forbidden(
        mixed $data = null, 
        string $message = "Forbidden Request", 
        int $statusCode = 403, 
        array $meta = []): JsonResponse
    {
         return self::error(
            data: $data,
            message: $message,
            meta:  $meta,
            statusCode: $statusCode
         );
    }


    public static function serverError(
        mixed $data = null, 
        string $message = "Server Error", 
        int $statusCode = 500, 
        array $meta = []): JsonResponse
    {
        return self::error(
            data: $data,
            message: $message,
            meta:  $meta,
            statusCode: $statusCode
        );
    }


    public static function customError(
        mixed $data = null, 
        string $message = "Custom Error", 
        int $statusCode = 422, 
        array $meta = []): JsonResponse
    {
        return self::error(
            data: $data,
            message: $message,
            meta:  $meta,
            statusCode: $statusCode
        );
    }


    public function customMessage(
        mixed $data = null, 
        string $message = "Custom Error", 
        int $statusCode = 200, 
        array $meta = []):JsonResponse 
    {
        return self::error(
            data: $data,
            message: $message,
            meta:  $meta,
            statusCode: $statusCode
        );
    }


    private static function response(
        bool $success, 
        mixed $data = null, 
        string $message = "", 
        int $statusCode = 200, 
        array $meta = []): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'meta' => $meta,
        ], $statusCode);
    }
}
