<?php 

namespace App\Domains\Shared\Services\Dojah;
use App\Domains\Shared\Services\ApiServices\ApiClient;
use Illuminate\Http\Client\Response;

class DojahClient
{
    protected string $base;
    public function __construct(protected ApiClient $client){
            $this->base = config('services.dojah.sandbox.url');
    } 


    public function get(string $url, mixed $query = []): Response  
    {
        return $this->client->get($this->base.'/'.ltrim($url, '/'), $query, $this->headers());
    }

    public function post(string $url, mixed $data = []): Response 
    {
        return $this->client->post($this->base.'/'.ltrim($url, '/'), $data, $this->headers());
    }

    public function put(string $url, mixed $data = []): Response 
    {
        return $this->client->put($this->base.'/'.ltrim($url, '/'), $data, $this->headers());
    }

    public function patch(string $url, mixed $data = []): Response 
    {
        return $this->client->patch($this->base.'/'.ltrim($url, '/'), $data, $this->headers());
    }

    public function delete(string $url, mixed $query = []): Response 
    {
        return $this->client->delete($this->base.'/'.ltrim($url, '/'), $query, $this->headers());
    }

    public function headers(): array
    {
        return [
            'Authorization' => 'Bearer' . config('services.dojah.sandbox.key'),
            'AppId'         => config('services.dojah.sandbox.app_id'),
            'Content-Type'  => 'application/json'
        ];
    }
}