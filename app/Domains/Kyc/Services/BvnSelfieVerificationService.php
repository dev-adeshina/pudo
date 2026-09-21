<?php 

namespace App\Domains\Kyc\Services;

use App\Domains\Shared\Services\Dojah\DojahBvnSelfieService;

class BvnSelfieVerificationService extends DojahBvnSelfieService
{
    public function verifyBvnWithSelfie(mixed $data)
    {
        return parent::verifyBvnSelfie($data);
    }
}