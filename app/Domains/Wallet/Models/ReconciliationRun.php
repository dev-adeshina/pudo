<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('provider', 'provider_account_id', 'internal_balance_minor', 'provider_balance_minor', 'difference_minor', 'status', 'started_at', 'completed_at')]
class ReconciliationRun extends Model
{
    protected $casts = [
        'internal_balance_minor' => 'integer',
        'provider_balance_minor' => 'integer',
        'difference_minor' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function providerAccount(): BelongsTo
    {
        return $this->belongsTo(ProviderAccount::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ReconciliationItem::class);
    }
}
