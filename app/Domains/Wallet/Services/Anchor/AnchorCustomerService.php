<?php 

namespace App\Domains\Wallet\Services\Anchor;

use Illuminate\Http\Client\Response;

class AnchorCustomerService 
{
    public function __construct(protected AnchorClient $client){}

    public function createCustomer(array $data): Response
    {
        return $this->client->post('customers', $data);
    }

    public function updateCustomer(array $data): Response 
    {
        return $this->client->put('customers/update/', $data);
    }

    public function fetchCustomer(string $id): Response 
    {
        return $this->client->get("customers/{$id}");
    }

    public function listCustomers(mixed $query = []): Response
    {
        return $this->client->get("customers", $query);
    }

    public function deleteCustomer(string $id): Response 
    {
        return $this->client->delete("customers/{$id}");
    }

    public function searchCustomer(array $query): Response 
    {
        return $this->client->get("customers/search", $query);
    }
}