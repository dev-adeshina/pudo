<?php

namespace App\Domains\Fulfilment\Order\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable('parent_id', 'name', 'slug', 'status', 'sort_order')]
class Category extends Model
{
    //

    public function parent(): BelongsTo 
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function item(): HasMany 
    {
        return $this->hasMany(Item::class);
    }
}
