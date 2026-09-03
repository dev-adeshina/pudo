<?php 

namespace App\Domains\Wallet\Workflows\OnboardCustomer;

use App\Domains\Wallet\Processes\OnboardProcesses\CreateCustomerProcess;
use App\Models\User;

class OnboardCustomersWorkflow{

    public function __construct(protected CreateCustomerProcess $createCustomerProcess){}

    public function start(User $user): void
    {
        $this->createCustomerProcess->start($user);
    }
    
    public function customerCreated()
    {

    }


    public function customerValidated()
    {
        
    }


    public function depositAccountCreated()
    {

    }

    public function virtualNubanRetrieved()
    {

    }
}