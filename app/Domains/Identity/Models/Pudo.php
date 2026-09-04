<?php

namespace App\Domains\Identity\Models;

use App\Models\AccessType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Pudo extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accessType(): MorphMany
    {
        return $this->morphMany(AccessType::class, 'accessable');
    }

    public function errand(): HasOne
    {
        return $this->hasOne(Errand::class);
    }

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class);
    }

    public function vride(): HasOne
    {
        return $this->hasOne(Vride::class);
    }
}
