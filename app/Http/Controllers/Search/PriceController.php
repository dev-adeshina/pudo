<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\PriceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Domains\Fulfilment\Items\Models\Item;

class PriceController extends Controller
{
    //

    public function marketLocationPrice(PriceRequest $request): JsonResponse
    {

        $item = $request->item;
        $location = $request->location;
        $min_amount = "500";
        $available = true;
        return ApiResponse::success([
            'item' => $item,
            'location' => $location,
            'amount' => $min_amount,
            'available' => $available,
        ]);
    }

    public function generalMarketPrice(PriceRequest $request): JsonResponse
    {

        $item = $request->item;
        $location = $request->location;
        $min_amount = "500";
        $available = true;


        return ApiResponse::success([
            'location' => [
                'local' => [
                    'item' => $item,
                    'location' => 'enugu',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_2' => [
                    'item' => $item,
                    'location' => 'ibadan',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_3' => [
                    'item' => $item,
                    'location' => 'oyo',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_4' => [
                    'item' => $item,
                    'location' => 'lagos',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_5' => [
                    'item' => $item,
                    'location' => 'jos',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
            ]
        ]);
    }


    public function SearchQuery(Request $request): JsonResponse
    {

        $item = Item::query()->with(['category', 'brand', 'vendor', 'market', 'location'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $searchItem = '%' . $search . '%';
                    $q->where('name', 'like', $searchItem)
                        ->orWhere('sku', 'like', $searchItem)
                        ->orWhere('description', 'like', $searchItem);
                });
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            // Price range
            ->when($request->min_price, function ($query, $price) {
                $query->where('price', '>=', $price);
            })

            ->when($request->max_price, function ($query, $price) {
                $query->where('price', '<=', $price);
            })

            // Vendor
            ->when($request->vendor_id, function ($query, $vendor) {
                $query->where('vendor_id', $vendor);
            })

            // Condition
            ->when($request->condition, function ($query, $condition) {
                $query->where('condition', $condition);
            })

            // Availability
            ->when($request->available !== null, function ($query) use ($request) {
                $query->where('available', $request->boolean('available'));
            })

            // Market
            ->when($request->market_id, function ($query, $market) {
                $query->where('market_id', $market);
            })

            // Location
            ->when($request->location_id, function ($query, $location) {
                $query->where('location_id', $location);
            })
            // Verified vendor
            ->when($request->boolean('verified_vendor'), function ($query) {
                $query->whereHas('vendor', function ($q) {
                    $q->where('verified', true);
                });
            })

            ->paginate(20);

        return ApiResponse::success($item);
    }
}
