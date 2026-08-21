<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

#[Fillable('currency', 'status')]
class Wallet extends Model
{
    
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(WalletAccount::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function fundAllocations(): HasMany
    {
        return $this->hasMany(FundAllocation::class);
    }

    public function paymentIntents(): HasMany
    {
        return $this->hasMany(PaymentIntent::class);
    }

    public function escrows(): HasMany
    {
        return $this->hasMany(Escrow::class, 'payer_wallet_id');
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function providerAccounts(): HasMany
    {
        return $this->hasMany(ProviderAccount::class);
    }
}
