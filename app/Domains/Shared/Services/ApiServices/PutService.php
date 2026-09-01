<?php 

namespace App\Domains\Shared\Services\ApiServices;
use Illuminate\Http\Client\Response;

class PutService 
{
    public function __construct(private ApiTransport $transport ){}
    public function execute(string $url, array $data = [], array $headers = []): Response 
    {
        return $this->transport->make($headers)->put($url, $data);
    }
}