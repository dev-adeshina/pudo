<?php

namespace App\Domains\Identity\Models;

use App\Models\AccessType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Admin extends Model
{
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accessType(): MorphMany
    {
        return $this->morphMany(AccessType::class, 'accessable');
    }
}
