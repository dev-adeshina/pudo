<?php

namespace App\Domains\Identity\Models;

use App\Enums\Kyc\KycLevel;
use App\Enums\Kyc\KycStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable('kycable_type', 'kycable_id', 'current_level', 'status', 'provider', 'provider_reference', 'verified_at')]
class Kyc extends Model
{

    protected function casts(): array
    {
        return [
            'current_level' => KycLevel::class,
            'status' => KycStatus::class,
            'verified_at' => 'datetime',
        ];
    }

    public function kycable(): MorphTo
    {
        return $this->morphTo();
    }

    public function verification(): HasOne
    {
        return $this->hasOne(KycVerification::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(KycDocument::class);
    }
}


