<?php 

namespace App\Domains\Shared\Services\Dojah;
use App\Domains\Shared\Services\Dojah\DojahClient;
use Illuminate\Http\Client\Response;

class DojahBvnSelfieService
{
     public function __construct(protected DojahClient $client){}
     public function verifyBvnSelfie(array $data): Response 
     {
         return $this->client->post('/api/v1/kyc/bvn/verify', $data);
     }
}