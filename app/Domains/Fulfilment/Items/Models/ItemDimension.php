<?php

namespace App\Domains\Fulfilment\Items\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('item_id', 'length_cm', 'width_cm', 'height_cm', 'weight_kg')]
class ItemDimension extends Model
{
    //
    protected $primaryKey = 'item_id';
    public $incrementing = false;
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
