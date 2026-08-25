<?php

namespace App\Http\Controllers\Vride;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vride\BookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Domains\Vride\Actions\BookAction;

class BookController extends Controller
{
    // 
    public function __construct(protected BookAction $action){}

    public function bookTrip(BookRequest $dto): JsonResponse
    {
        $data = $this->action->execute($dto);       

        return ApiResponse::success($data);
    }
}
