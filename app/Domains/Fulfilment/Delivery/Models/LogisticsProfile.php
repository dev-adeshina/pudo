<?php

namespace App\Domains\Fulfilment\Delivery\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

#[Fillable('name', 'description', 'default_weight_class_id', 'default_size_class_id')]
class LogisticsProfile extends Model
{
    use Searchable;
    
    public function handlingClasses(): BelongsToMany
    {
        return $this->belongsToMany(HandlingClass::class, 'logistics_profile_handling_class');
    }

    public function defaultWeightClass(): BelongsTo { return $this->belongsTo(WeightClass::class, 'default_weight_class_id'); }
    public function defaultSizeClass(): BelongsTo { return $this->belongsTo(SizeClass::class, 'default_size_class_id'); }
    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
