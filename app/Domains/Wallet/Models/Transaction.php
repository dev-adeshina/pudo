<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;


#[Fillable('uuid', 'signature', 'wallet_id', 'root_transaction_id', 'parent_transaction_id', 'type', 'amount_minor', 'currency', 'status', 'reference', 'completed_at')]
class Transaction extends Model
{
    

    protected $casts = [
        'amount_minor' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function root(): BelongsTo
    {
        return $this->belongsTo(
            Transaction::class,
            'root_transaction_id'
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            Transaction::class,
            'parent_transaction_id'
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            Transaction::class,
            'parent_transaction_id'
        );
    }

    public function initiator(): MorphTo
    {
        return $this->morphTo();
    }

    public function journalEntries(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(TransactionLink::class);
    }

    public function fundAllocations(): HasMany
    {
        return $this->hasMany(FundAllocation::class);
    }

    public function providerTransactions(): HasMany
    {
        return $this->hasMany(ProviderTransaction::class);
    }

    public function escrowTransactions(): HasMany
    {
        return $this->hasMany(EscrowTransaction::class);
    }

    public function paymentIntents(): HasMany
    {
        return $this->hasMany(PaymentIntent::class);
    }

    public function withdrawal(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }
}
