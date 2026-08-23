<?php

namespace App\Domains\Fulfilment\Items\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Laravel\Scout\Searchable;

#[Fillable('item_id', 'path', 'sort_order', 'is_primary')]
class ItemImage extends Model
{
    use Searchable;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
