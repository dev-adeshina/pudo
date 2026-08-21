<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('order_type', 'order_id', 'payer_wallet_id', 'payee_wallet_id', 'amount_minor', 'currency', 'status', 'released_at', 'refunded_at')]
class Escrow extends Model
{
    protected $casts = [
        'amount_minor' => 'integer',
        'released_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    public function payerWallet(): BelongsTo
    {
        return $this->belongsTo(
            Wallet::class,
            'payer_wallet_id'
        );
    }

    public function payeeWallet(): BelongsTo
    {
        return $this->belongsTo(
            Wallet::class,
            'payee_wallet_id'
        );
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(EscrowTransaction::class);
    }
}
