<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable('name', 'code', 'description')]
class Skill extends Model
{
    //

    public function errandskill(): HasOne 
    {
        return $this->hasOne(ErrandSkill::class);
    }
}


