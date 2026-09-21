<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\User;

class Actor extends Model
{
    public function pudo(): BelongsTo
    {
        return $this->belongsTo(Pudo::class);
    }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function kyc(): MorphOne
    {
        return $this->morphOne(Kyc::class, 'kycable');
    }
}
