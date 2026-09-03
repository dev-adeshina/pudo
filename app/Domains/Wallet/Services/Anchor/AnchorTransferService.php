<?php

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorTransferService
{
    public function __construct(protected AnchorClient $client) {}

    public function createTransfer(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function verifyTransafer(array $data): Response
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function fetchTransfer(string $id): Response
    {
        return $this->client->get("kyc/{$id}");
    }

    public function listTransfer(mixed $query = []): Response
    {
        return $this->client->get("kyc", $query);
    }

}
