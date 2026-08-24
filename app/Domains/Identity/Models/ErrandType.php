<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable('name', 'slug', 'status')]
class ErrandType extends Model
{
    
    public function errand(): HasOne
    {
        return $this->hasOne(Errand::class);
    }
}


