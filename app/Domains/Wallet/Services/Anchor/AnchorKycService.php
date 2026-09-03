<?php 

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorKycService 
{
    public function __construct(protected AnchorClient $client){}

    public function createKyc(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function updateKyc(array $data): Response 
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function fetchKyc(string $id): Response 
    {
        return $this->client->get("kyc/{$id}");
    }

    public function listKyc(mixed $query = []): Response
    {
        return $this->client->get("kyc", $query);
    }

    public function deleteKyc(string $id): Response 
    {
        return $this->client->delete("kyc/{$id}");
    }

    public function searchKyc(array $query): Response 
    {
        return $this->client->get("kyc/search", $query);
    }
}