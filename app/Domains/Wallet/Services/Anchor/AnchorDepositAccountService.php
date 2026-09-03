<?php

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorDepositAccountService
{
    public function __construct(protected AnchorClient $client) {}

    public function createDepositAccount(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function updateDepositAccount(array $data): Response
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function fetchBalance(string $id): Response
    {
        return $this->client->get("kyc/{$id}");
    }

    public function fetchDepositAccount(mixed $query = []): Response
    {
        return $this->client->get("kyc", $query);
    }

    public function listDepositAccount(string $id): Response
    {
        return $this->client->delete("kyc/{$id}");
    }

    public function freazeDepositAccount(array $query): Response
    {
        return $this->client->get("kyc/search", $query);
    }

    public function unFreazeDepositAccount(array $query): Response
    {
        return $this->client->get("kyc/search", $query);
    }

    public function listRootAccounts(array $query): Response 
    {
        return $this->client->get("kyc/search", $query);
    }
}
