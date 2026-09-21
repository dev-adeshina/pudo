<?php 

namespace App\Enums\Kyc;

enum KycVerificationType: string 
{
    case BVN = 'bvn';
    case SELFIE = 'selfie';
}