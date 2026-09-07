<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('skill_id', 'errand_id')]
class ErrandSkill extends Model
{
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function errand(): BelongsTo
    {
        return $this->belongsTo(Errand::class);
    }
}


