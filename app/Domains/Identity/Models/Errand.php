<?php

namespace App\Domains\Identity\Models;

use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

#[Fillable('pudo_id', 'errand_type_id', 'status')]
class Errand extends Model
{
    public function pudo(): BelongsTo
    {
        return $this->belongsTo(Pudo::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ErrandType::class);
    }

    public function profile(): HasOne 
    {
        return $this->hasOne(ErrandProfile::class);
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(ErrandKyc::class);
    }

    public function wallet(): MorphOne
    {
        return $this->morphOne(Wallet::class, 'owner');
    }
}
