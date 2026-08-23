<?php

namespace App\Domains\Fulfilment\Order\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use App\Domains\Identity\Models\Vendor;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

#[Fillable('name', 'slug', 'status', 'created_by_vendor_id', 'logo_path')]
class Brand extends Model
{
    use Searchable;


    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function createdBy(): BelongsTo 
    {
        return $this->belongsTo(Vendor::class, 'created_by_vendor_id');
    }
}
