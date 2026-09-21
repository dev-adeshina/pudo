<?php 

namespace App\Domains\Shared\Services\Dojah;
use App\Domains\Shared\Services\Dojah\DojahClient;
use Illuminate\Http\Client\Response;

class DojahMobileVerificationService
{
     public function __construct(protected DojahClient $client){}

     public function verifyMobileNumber(array $data): Response 
     {
         return $this->client->get('api/v1/kyc/phone_number', $data);
     }
}