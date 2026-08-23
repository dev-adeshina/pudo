<?php

namespace App\Domains\Fulfilment\Items\Models;

use App\Domains\Fulfilment\Delivery\Models\HandlingClass;
use App\Domains\Fulfilment\Delivery\Models\LogisticsProfile;
use App\Domains\Fulfilment\Delivery\Models\SizeClass;
use App\Domains\Fulfilment\Delivery\Models\WeightClass;
use App\Domains\Fulfilment\Order\Models\Brand;
use App\Domains\Fulfilment\Order\Models\Category;
use App\Domains\Identity\Models\Vendor;
use App\Domains\Identity\Models\VendorLocation;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Laravel\Scout\Engines\Engine;
use Laravel\Scout\Scout;

#[Fillable('vendor_id', 'vendor_location_id', 'category_id', 'brand_id',
        'logistics_profile_id', 'weight_class_id', 'size_class_id',
        'name', 'slug', 'description', 'sku', 'price', 'currency',
        'stock_quantity', 'status',
)]
class Item extends Model
{
 
    //

    use SoftDeletes, Searchable;
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo 
    {
        return $this->belongsTo(Brand::class);
    }

    public function vendor(): BelongsTo 
    {
        return $this->belongsTo(Vendor::class);
    }

    public function vendorlocation(): BelongsTo
    {
        return $this->belongsTo(VendorLocation::class);
    }

    public function handlingclass(): BelongsToMany 
    {
        return $this->belongsToMany(HandlingClass::class, 'item_handling_class');
    }

    public function logisticsprofile(): BelongsTo 
    {
        return $this->belongsTo(LogisticsProfile::class);
    }

    public function sizeclass(): BelongsTo 
    {
        return $this->belongsTo(SizeClass::class);
    }

    public function weightclass(): BelongsTo 
    {
        return $this->belongsTo(WeightClass::class);
    }

    public function images(): HasMany 
    {
        return $this->hasMany(ItemImage::class);
    }

    public function dimensions(): HasOne
    {
        return $this->hasOne(ItemDimension::class);
    }

    #[SearchUsingPrefix('id', 'vendor', 'vendor_location_id', 'category_id', 'brand_id', 'name', 'logistics_profile_id', '')]
    #[SearchUsingFullText('slug', 'description', 'price', 'currency')]
    public function toSearchableArray(): array
    {
        return [
           'id'    => $this->id,
           'vendor' => $this->vendor_id,
           'vendor_location_id' => $this->vendor_location_id,
           'category_id' => $this->category_id,
           'brand_id' => $this->brand_id,
           'logistics_profile_id' => $this->logistics_profile_id,
           'weight_class_id' => $this->weight_class_id,
           'size_class_id' => $this->size_class_id,
           'name' => $this->name,
           'slug' => $this->slug,
           'description' => $this->description,
           'sku' => $this->sku,
           'price' => $this->price,
           'currency' => $this->currency
        ];
    }

    public function searchableUsing(): Engine
    {
        return Scout::engine('meilisearch');
    }
    
}


