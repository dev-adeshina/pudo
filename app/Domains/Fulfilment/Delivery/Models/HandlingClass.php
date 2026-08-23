<?php

namespace App\Domains\Fulfilment\Delivery\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

#[Fillable('code', 'label', 'description', 'affects_pricing')]
class HandlingClass extends Model
{
    use Searchable;

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
