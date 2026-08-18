<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Domains\Fulfilment\Order\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //
    public function show(): JsonResponse
    {
        $brand = Brand::first();
        if(!$brand) 
            return ApiResponse::notFound();
        return ApiResponse::success(Brand::all());
    }

    public function store(BrandRequest $request): JsonResponse 
    {
        $brand = Brand::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'status'    => 'pending',
            'created_by_vendor_id'  => $request->created_by_vendor_id ?? null,
            'logo_path'     => $request->logo_path ?? null
        ]);
        return ApiResponse::success($brand);
    }
}
