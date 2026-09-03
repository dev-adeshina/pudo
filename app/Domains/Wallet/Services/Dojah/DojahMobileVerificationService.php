<?php 

namespace App\Domains\Wallet\Services\Dojah;
use App\Domains\Shared\Services\ApiServices\ApiClient;
use Illuminate\Http\Client\Response;

class DojahMobileVerificationService
{
     public function __construct(protected DojahClient $client){}

     public function verifyMobileNumber(array $data): Response 
     {
         return $this->client->gets('api/v1/kyc/phone_number', $data);
     }
}