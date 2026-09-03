<?php 

namespace App\Domains\Wallet\Processes\OnboardProcesses;

use App\Domains\Wallet\Services\Anchor\AnchorCustomerService;
use App\Models\User;


class CreateCustomerProcess
{
    public function __construct(protected AnchorCustomerService $anchorCustomerService){}
    public function start(User $user)
    {
        // Implement the logic for creating a customer here
    }
}
    
