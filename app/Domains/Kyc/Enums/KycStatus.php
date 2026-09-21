<?php 

namespace App\Enums\Kyc;

enum KycStatus: string 
{
    case PENDING = 'pending';
    case IN_REVIEW = 'in_review';
    case VERIFIED = 'verified';
    case FAILED = 'failed';
    case REJECTED = 'rejected';
}