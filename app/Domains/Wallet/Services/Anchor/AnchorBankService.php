<?php 

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorBankService
{
    public function __construct(protected AnchorClient $client){}

    public function verifyAccountNumber(array $data): Response 
    {
        return $this->client->post('kyc', $data);
    }

    public function listBanks(array $data): Response 
    {
        return $this->client->post('kyc', $data);
    }
}