<?php 

namespace App\Domains\Kyc\Services;
use App\Domains\Shared\Services\Dojah\DojahClient;
use Illuminate\Http\Client\Response;

class DocumentVerificationService 
{
    public function __construct(protected DojahClient $client){} 
    
    public function verifyDriverLicense(mixed $data): Response 
    {

        return $this->client->get('/api/v1/kyc/dl', $data);
    }


    public function verifyVotersCard(mixed $data): Response 
    {
        return $this->client->get('/api/v1/kyc/voter_card', $data);
    }


    public function verifyPassport(mixed $data): Response 
    {
        return $this->client->get('/api/v1/kyc/passport', $data);
    }

    public function verifyNationalId(mixed $data): Response 
    {
        return $this->client->get('/api/v1/kyc/nin', $data);
    }

    public function verifyNinSlip(mixed $data): Response 
    {
        return $this->client->get('/api/v1/kyc/nin_slip', $data);
    }
}