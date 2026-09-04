<?php

namespace App\Domains\Identity\Models;

use App\Domains\Fulfilment\Items\Models\Item;
use App\Domains\Wallet\Models\ComplianceProfile;
use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

#[Fillable('pudo_id', 'business_name', 'slug', 'status')]

class Vendor extends Model
{
    //

    public function pudo(): BelongsTo
    {
        return $this->belongsTo(Pudo::class);
    }

    public function profileType(): BelongsTo
    {
        return $this->belongsTo(ProfileType::class);
    }

    public function location(): HasMany
    {
        return $this->hasMany(VendorLocation::class);
    }

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(VendorKyc::class);
    }

    public function wallet(): MorphOne
    {
        return $this->morphOne(Wallet::class, 'owner');
    }

    public function complianceProfile(): MorphOne
    {
        return $this->morphOne(ComplianceProfile::class, 'subject');
    }
}
