<?php 

namespace App\Domains\Wallet\Processes\VerificationProcess;

use App\Models\User;
use App\Domains\Wallet\Models\ComplianceProfile;
use Illuminate\Support\Facades\Log;
use App\Domains\Wallet\Services\Dojah\DojahSelfieAndLookUpService;

class BvnNinSelfileProcess
{
    public function __construct(protected DojahSelfieAndLookUpService $service){}
    protected bool $validated;
    protected User $user;
    public function start(mixed $data)
    {
        $this->validate($data);
        $this->process($data);
        $this->localize();
        $this->trail();
    }

    public function validate(mixed $data)
    {
        $this->user = User::query()->find($data->user->id);
        $ownerType = $this->user->userExtended->profileType->getEntityClass;

        // if($ownerType->complianceProfile->kyc_status === 'verified'){
        //     $this->validated = true;
        // }else{
        //     $this->validated = false;
        // }

        return $ownerType->complianceProfile->kyc_status === 'verified' ? $this->validated = true : $this->validated = false;
    }

    public function process(array $data)
    {
        if($this->validated === false)
            return  $this->service->verifySelfieAndLookUp($data);

    }  
    
    public function localize(){
        ComplianceProfile::create([
            'subject'   => $this->user->userExtended->profileType->getEntityClass,
            'kyc_status' => 'verified',
            'risk_level' => 'low',
            'verified_at' => now(),
            'reviewed_at' => now(),
        ]);
    }

    public function trail()
    {
        Log::info('KYC Process completed successfully.');
    }
}