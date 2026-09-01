<?php 

namespace App\Domains\Shared\Services\ApiServices;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ApiTransport 
{
    public function make(array $headers = []): PendingRequest
    {
        return Http::withHeaders($headers)->acceptJson()->timeout(30)->connectTimeout(10)->retry(3, 100);
    }
}