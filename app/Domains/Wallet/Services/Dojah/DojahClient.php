<?php 

namespace App\Domains\Wallet\Services\Dojah;
use App\Domains\Shared\Services\ApiServices\ApiClient;
use Illuminate\Http\Client\Response;

class DojahClient
{
    protected string $base;
    public function __construct(protected ApiClient $client){
            $this->base = config('services.dojah.sandbox.url');
    } 


    public function gets(string $url, array $query = []): Response  
    {
        return $this->client->get($this->base.'/'.ltrim($url, '/'), $query, $this->headers());
    }

    public function posts(string $url, array $data = []): Response 
    {
        return $this->client->post($this->base.'/'.ltrim($url, '/'), $data, $this->headers());
    }

    public function puts(string $url, array $data = []): Response 
    {
        return $this->client->put($this->base.'/'.ltrim($url, '/'), $data, $this->headers());
    }

    public function patchs(string $url, array $data = []): Response 
    {
        return $this->client->patch($this->base.'/'.ltrim($url, '/'), $data, $this->headers());
    }

    public function deletes(string $url, array $query = []): Response 
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