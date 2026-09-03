<?php 

namespace App\Domains\Wallet\Services\Anchor;
use Illuminate\Http\Client\Response;

class AnchorEventService 
{
    public function __construct(protected AnchorClient $client){}

    public function listEvent(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function fetchEvent(array $data): Response
    {
        return $this->client->post('kyc', $data);
    }

    public function eventType(array $data): Response 
    {
        return $this->client->post('kyc', $data);
    }
}