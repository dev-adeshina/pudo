<?php

namespace App\Domains\Vride\Actions;
use App\Domains\Vride\Services\Trips\TripService;

class TripAction {
    public function __construct(protected TripService $service){}

    public function execute($data)
    {
       return  $this->service->run($data);
    }
}