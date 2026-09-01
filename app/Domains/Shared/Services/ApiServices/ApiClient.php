<?php 

namespace App\Domains\Shared\Services\ApiServices;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ApiClient 
{
    public function __construct(
        private GetService $get,
        private PostService $post,
        private PutService $put,
        private PatchService $patch,
        private DeleteService $delete
    ){}


    public function client(array $headers = []): PendingRequest 
    {
        return Http::withHeaders($headers)->acceptJson()->timeout(30)->connectTimeout(10)->retry(3, 100);
    }

    public function get(string $url, array $query = [], array $headers = []): Response 
    {
        return $this->get->execute($url, $query, $headers);
    }

    public function post(string $url, array $data = [], array $headers = []): Response 
    {
        return $this->post->execute($url, $data, $headers);
    }

    public function patch(string $url, array $data = [], array $headers = []): Response 
    {
        return $this->patch->execute($url, $data, $headers);
    }

    public function put(string $url, array $data = [], array $headers = []): Response
    {
        return $this->put->execute($url, $data, $headers);
    }

    public function delete(string $url, array $query = [], array $headers = []): Response 
    {
        return $this->delete->execute($url, $query, $headers);
    }
}