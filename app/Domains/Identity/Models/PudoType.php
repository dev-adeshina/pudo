<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Domains\Wallet\Models\ComplianceProfile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
#[Fillable('name', 'slug', 'is_active')]
class PudoType extends Model
{
    

    public function pudos(): HasMany
    {
        return $this->hasMany(Pudo::class);
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

    // public function complianceProfile(): MorphOne
    // {
    //     return $this->morphOne(ComplianceProfile::class, 'subject');
    // }
}


