<?php 

namespace App\Domains\Kyc\contracts;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface kycable 
{
    public function kyc(): MorphOne;
}