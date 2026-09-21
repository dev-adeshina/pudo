<?php 

namespace App\Enums\Kyc;

enum KycDocumentType: string 
{
    case DRIVERS_LICENSE = 'drivers_license';
    case VOTERS_CARD = 'voters_card';
    case PASSPORT = 'passport';
    case NATIONAL_ID = 'national_id';
    case NIN_SLIP = 'nin_slip';
}