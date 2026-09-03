<?php 

namespace App\Domains\Wallet\Services\Anchor;
use Illuminate\Http\Client\Response;

class AnchorCounterPartyAccountService 
{
    public function __construct(protected AnchorClient $client){}

    public function createCounterParty(array $data): Response
    {
        return $this->client->post('counterparty', $data);
    }

    public function updateCounterParty(array $data): Response
    {
        return $this->client->post('counterparty', $data);
    }

    public function fetchCounterParty(array $data): Response
    {
        return $this->client->post('counterparty', $data);
    }

    public function listCounterParty(array $data): Response
    {
        return $this->client->post('counterparty', $data);
    }

    public function deleteCounterParty(array $data): Response
    {
        return $this->client->post('counterparty', $data);
    }
}