<?php

namespace App\Domains\Wallet\Actions;

use App\Domains\Wallet\Processes\VerificationProcess\BvnNinSelfileProcess;

class KycAction
{
    public function __construct(protected BvnNinSelfileProcess $kycService){}

    public function execute($data)
    {
        // Implement the logic for KYC action here
    }
}