<?php 

namespace App\Domains\Wallet\Services\Dojah;
use App\Domains\Shared\Services\ApiServices\ApiClient;
use Illuminate\Http\Client\Response;

class DojahIdentityAndAgeVerificationService
{
     public function __construct(protected DojahClient $client){}
     public function verifyIdentityAndAge(array $data): Response 
     {
         return $this->client->gets('/api/v1/kyc/age_verification', $data);
     }
}