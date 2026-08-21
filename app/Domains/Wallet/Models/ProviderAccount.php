<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('wallet_id', 'provider', 'provider_account_id', 'account_number', 'account_name', 'bank_code', 'currency', 'status', 'is_primary', 'opened_at', 'closed_at')]
class ProviderAccount extends Model
{
    protected $casts = [
        'is_primary' => 'boolean',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(ProviderTransaction::class);
    }
}
