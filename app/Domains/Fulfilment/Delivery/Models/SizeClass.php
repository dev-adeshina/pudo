<?php

namespace App\Domains\Fulfilment\Delivery\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SizeClass extends Model
{
    //

        public function item(): HasMany
        {
            return $this->hasMany(Item::class);
        }
}
