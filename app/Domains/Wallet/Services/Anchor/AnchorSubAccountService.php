<?php

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorSubAccountService
{
    public function __construct(protected AnchorClient $client) {}

    public function createSbAccount(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function fetchSubAccountBalance(array $data): Response
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function fetchById(string $id): Response
    {
        return $this->client->get("kyc/{$id}");
    }

    public function updateSubAccount(mixed $query = []): Response
    {
        return $this->client->get("kyc", $query);
    }

    public function listSubAccount(string $id): Response
    {
        return $this->client->delete("kyc/{$id}");
    }

}
