<?php 

namespace App\Domains\Wallet\Services;


use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WalletService 
{

    public function getWallet(Model $owner): Wallet 
    {
        $wallet = $owner->wallet;

        if(!$wallet)
            throw new ModelNotFoundException('Wallet not found for this owner.');

        return $wallet;
    } 

    public function createWallet(Model $owner, string $currency = 'NGN'): Wallet 
    {
        return $owner->wallet()->create([
            'currency'  => strtoupper($currency),
            'status'    => 'active'
        ]);
    }

    public function getOrCreateWallet(Model $owner, string $currency = 'NGN'): Wallet 
    {
        return $owner->wallet()->firstOrCreate([], [
            'currency' => strtoupper($currency),
            'status' => 'active',
        ]);
    }
}