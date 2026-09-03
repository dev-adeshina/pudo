<?php 

namespace App\Domains\Wallet\Services\Dojah;
use App\Domains\Shared\Services\ApiServices\ApiClient;
use Illuminate\Http\Client\Response;

class DojahSelfieAndLookUpService
{
     public function __construct(protected DojahClient $client){}
     public function verifySelfieAndLookUp(array $data): Response 
     {
         return $this->client->posts('/api/v1/kyc/bvn/verify', $data);
     }
}