<?php

namespace App\Domains\Identity\Models;

use App\Domains\Delivery\Models\Trip;
use App\Domains\Wallet\Models\ComplianceProfile;
use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

#[Fillable('pudo_id', 'name', 'slug', 'description', 'requires_drivers_license', 'requires_vehicle_registration', 'requires_insurance', 'status')]
class VRide extends Model
{
    //
    public function pudo(): BelongsTo
    {
        return $this->belongsTo(Pudo::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(VRideType::class);
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(VRideKyc::class);
    }

    public function trip(): HasMany
    {
        return $this->hasMany(Trip::class);
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
