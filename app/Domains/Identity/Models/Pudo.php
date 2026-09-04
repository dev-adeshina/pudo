<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AccessType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Pudo extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PudoType::class);
    }

    public function accessType(): MorphMany
    {
        return $this->morphMany(AccessType::class, 'accessable');
    }

    public function errand(): HasOne
    {
        return $this->hasOne(Errand::class);
    }
}
