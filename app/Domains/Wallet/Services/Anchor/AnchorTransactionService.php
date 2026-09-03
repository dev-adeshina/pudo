<?php

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorTransactionService
{
    public function __construct(protected AnchorClient $client) {}

    public function fetchTransaction(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function listTransactions(array $data): Response
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function listSubAccountTransactions(string $id): Response
    {
        return $this->client->get("kyc/{$id}");
    }
}
