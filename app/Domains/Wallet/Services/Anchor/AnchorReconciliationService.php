<?php

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;


class AnchorReconciliationService
{
    public function __construct(protected AnchorClient $client) {}

    public function createStatement(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function fetchStatement(array $data): Response
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function listStatement(string $id): Response
    {
        return $this->client->get("kyc/{$id}");
    }

    public function downloadStatement(mixed $query = []): Response
    {
        return $this->client->get("kyc", $query);
    }

    
}
