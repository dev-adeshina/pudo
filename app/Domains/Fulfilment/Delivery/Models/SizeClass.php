<?php

namespace App\Domains\Fulfilment\Delivery\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

#[Fillable('name', 'max_volume_cm3')]
class SizeClass extends Model
{
    use Searchable;

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
