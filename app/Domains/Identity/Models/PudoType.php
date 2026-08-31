<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Domains\Wallet\Models\ComplianceProfile;

#[Fillable('name', 'slug', 'is_active')]
class PudoType extends Model
{
    //


    public function complianceProfile(): MorphOne
    {
        return $this->morphOne(ComplianceProfile::class, 'subject');
    }
}


