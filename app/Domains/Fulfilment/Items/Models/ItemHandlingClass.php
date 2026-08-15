<?php

namespace App\Domains\Fulfilment\Items\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('code', 'label', 'description', 'affects_pricing')]
class ItemHandlingClass extends Model
{
    
public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
