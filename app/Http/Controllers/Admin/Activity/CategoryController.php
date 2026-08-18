<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Domains\Fulfilment\Order\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{   
    public function show(Request $request): JsonResponse
    {
        $cat = Category::first();
        if(!$cat) 
            return ApiResponse::notFound();
        $cat = Category::all();
        return ApiResponse::success($cat);
    }

    public function store(CategoryRequest $request): JsonResponse 
    {
        

        $cat = Category::create([
            'parent_id' =>  $request->parent_id ?? null,
            'name'      =>  $request->name,
            'slug'      =>  Str::slug($request->name),
            'status'    =>  'active',
        ]);

        if(!$cat) 
            return ApiResponse::error('Ooops! something went wrong');
        return ApiResponse::success($cat, 'You have successfully created a category');
    }
}
