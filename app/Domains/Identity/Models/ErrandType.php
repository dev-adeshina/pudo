<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Domains\Wallet\Models\ComplianceProfile;

#[Fillable('name', 'slug', 'status')]
class ErrandType extends Model
{
    
    public function errand(): HasOne
    {
        return $this->hasOne(Errand::class);
    }

    public function complianceProfile(): MorphOne
    {
        return $this->morphOne(ComplianceProfile::class, 'subject');
    }
}


