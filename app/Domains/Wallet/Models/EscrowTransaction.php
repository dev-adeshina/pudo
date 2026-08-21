<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('escrow_id', 'transaction_id', 'type', 'amount_minor')]
class EscrowTransaction extends Model
{

    protected $casts = [
        'amount_minor' => 'integer',
    ];

    public function escrow(): BelongsTo
    {
        return $this->belongsTo(Escrow::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
