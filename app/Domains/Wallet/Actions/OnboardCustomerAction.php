<?php 

namespace App\Domains\Wallet\Actions;
use App\Models\User;
use App\Domains\Wallet\Workflows\OnboardCustomer\OnboardCustomersWorkflow;

class OnboardCustomerAction{
    
    public function __construct(protected OnboardCustomersWorkflow $workflow)
    {
        // Initialize any dependencies or services needed for onboarding a customer
    }
    public function execute(User $user): void
    {
        $this->workflow->start($user);
    }
}