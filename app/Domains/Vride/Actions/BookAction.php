<?php 

namespace App\Domains\Vride\Actions;

use App\Domains\Vride\Services\Bookings\BookService;

class BookAction 
{
    public function __construct(protected BookService $service){}
    public function execute($data) {
        $result = $this->service->run($data);
        return $result;
    }
}