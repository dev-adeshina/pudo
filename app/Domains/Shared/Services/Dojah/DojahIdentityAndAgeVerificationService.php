<?php 

namespace App\Domains\Shared\Services\Dojah;
use App\Domains\Shared\Services\Dojah\DojahClient;
use Illuminate\Http\Client\Response;

class DojahIdentityAndAgeVerificationService
{
     public function __construct(protected DojahClient $client){}
     public function verifyIdentityAndAge(array $data): Response 
     {
         return $this->client->get('/api/v1/kyc/age_verification', $data);
     }
}