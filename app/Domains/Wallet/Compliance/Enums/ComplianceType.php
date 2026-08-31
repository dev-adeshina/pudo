<?php 

namespace App\Domains\Wallet\Compliance\Enums;

enum ComplianceType: String 
{
    case ONGOING    = 'ongoing';
    case PENDING    = 'pending';
    case COMPLETED  = 'completed';
    case FAILED     = 'failed';
    case ABANDONED  = 'abandoned';
}


