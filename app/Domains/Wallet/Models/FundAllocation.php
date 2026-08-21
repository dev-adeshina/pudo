<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('wallet_id', 'transaction_id', 'root_transaction_id', 'parent_allocation_id', 'source_type', 'original_amount_minor', 'remaining_amount_minor', 'withdrawal_policy')]
class FundAllocation extends Model
{
    protected $casts = [
        'original_amount_minor' => 'integer',
        'remaining_amount_minor' => 'integer',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function rootTransaction(): BelongsTo
    {
        return $this->belongsTo(
            Transaction::class,
            'root_transaction_id'
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            FundAllocation::class,
            'parent_allocation_id'
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            FundAllocation::class,
            'parent_allocation_id'
        );
    }
}
