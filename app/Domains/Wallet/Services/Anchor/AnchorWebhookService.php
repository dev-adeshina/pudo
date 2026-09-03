<?php 

namespace App\Domains\Wallet\Services\Anchor;

class AnchorWebhookService 
{
    public function __construct(protected AnchorClient $client){}

    public function createWebhook(array $data): \Illuminate\Http\Client\Response
    {
        return $this->client->post('kyc', $data);
    }

    public function updateWebhook(array $data): \Illuminate\Http\Client\Response 
    {
        return $this->client->put('kyc/update/', $data);
    }

    public function fetchWebhook(string $id): \Illuminate\Http\Client\Response 
    {
        return $this->client->get("kyc/{$id}");
    }

    public function listWebhooks(mixed $query = []): \Illuminate\Http\Client\Response
    {
        return $this->client->get("kyc", $query);
    }

    public function deleteWebhook(string $id): \Illuminate\Http\Client\Response 
    {
        return $this->client->delete("kyc/{$id}");
    }

    public function sendSampleEventToAWebhook(array $query): \Illuminate\Http\Client\Response 
    {
        return $this->client->get("kyc/search", $query);
    }
}