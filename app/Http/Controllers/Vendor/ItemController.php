<?php

namespace App\Http\Controllers\Vendor;

use App\Domains\Fulfilment\Delivery\Models\LogisticsProfile;
use App\Domains\Fulfilment\Delivery\Models\SizeClass;
use App\Domains\Fulfilment\Delivery\Models\WeightClass;
use App\Domains\Fulfilment\Items\Models\Item;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\ItemRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Domains\Fulfilment\Order\Models\Category;
use App\Domains\Identity\Models\VendorLocation;

class ItemController extends Controller
{
    //

    public function show(Request $request): JsonResponse 
    {
        $user = $request->user();
        if(!$user->vendor->id)
            return ApiResponse::forbidden(message: 'You are not yet a vendor');

        $check = Item::where('vendor_id', $user->vendor->id)->exists();
        if(!$check) 
            return ApiResponse::notFound(message: 'You don\'t have any product on display yet');

        return ApiResponse::success(Item::where('vendor_id', $user->vendor->id)->paginate(10));
    }


    public function store(ItemRequest $request) : JsonResponse 
    {

        $user = $request->user();
        $vendorLocationCheck = $user->vendor->location()->where('id', $request->vendor_location_id)->first();
        if(!$vendorLocationCheck)
            return ApiResponse::error(message: 'contack the admin, because you do not register any of the location you claim'); 

        $category = Category::where('id', $request->category_id)->first();

        $item = Item::create([
            'vendor_id'             =>      $user->vendor->id,
            'vendor_location_id'    =>      $vendorLocationCheck->id,
            'category_id'           =>      $request->category_id,
            'brand_id'              =>      $request->brand_id,
            'logistics_profile_id'  =>      $request->logistics_profile_id,
            'weight_class_id'       =>      $request->weight_class_id,
            'size_class_id'         =>      $request->size_class_id,
            'name'                  =>      $request->name,
            'slug'                  =>      Str::slug($request->name),
            'description'           =>      $request->description,
            'sku'                   =>      $this->skuGenerator(id: $user->vendor->id, code: strtoupper(Str::substr($category->name, 0, 2))),
            'price'                 =>      $request->price,
            'currency'              =>      $request->currency,
            'stock_quantity'        =>      $request->stock_quantity,
            'status'                =>     'draft',


        ]);
        if(!$item) 
            return ApiResponse::error(message: 'Ooops! something went wrong, kindly report to the admin');

        $carted = [
            'product'   => $item,
            ['related' => [
                 'category'  => $item->category->name, 
                'brand'     => $item->brand->name,
                'location'  => VendorLocation::where('id', $item->vendor_location_id)->first(),
                'lg_profile' => LogisticsProfile::where('id', $item->logistics_profile_id)->first(),
                'size'      => SizeClass::where('id', $request->size_class_id)->first(),
                'weight'    => WeightClass::where('id', $request->weight_class_id)->first()
                ]
            ],
           
        ];
        return ApiResponse::success($carted, 'Product created successfully');
    }


    public function skuGenerator(int $id, string $code)
    {
        return "VND". $id ."-".$code."-".strtoupper(Str::random(6));
    }
}

