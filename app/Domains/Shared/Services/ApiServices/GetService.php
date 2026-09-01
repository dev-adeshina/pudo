<?php 

namespace App\Domains\Shared\Services\ApiServices;
use Illuminate\Http\Client\Response;

class GetService 
{
    public function __construct(private ApiTransport $transport ){}
    public function execute(string $url, array $query = [], array $headers = []): Response 
    {
        return $this->transport->make($headers)->get($url, $query);
    }
}