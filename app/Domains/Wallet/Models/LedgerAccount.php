<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('code', 'name', 'type', 'currency', 'status',)]
class LedgerAccount extends Model
{

    public function journalLines(): HasMany
    {
        return $this->hasMany(JournalLine::class);
    }
}
