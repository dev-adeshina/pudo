<?php 

namespace App\Domains\Wallet\Services;

use App\Domains\Feedback\DTOs\FeedbackMessage;
use App\Domains\Feedback\Services\FeedbackService;
use App\Domains\Wallet\Compliance\Enums\ComplianceType;
use Illuminate\Database\Eloquent\Model;

class ComplianceService 
{
    public function __construct(protected FeedbackService $feedService){}
    public function checkCompliance(Model $subject): FeedbackMessage
    {
        $compliance = $subject->complianceProfile;
        if(!$compliance)
            return $this->feedService->error(message: "No compliance to this user");

        if($compliance->kyc_status === ComplianceType::PENDING)
            return $this->feedService->warning(message: "Your complaince is not approved, try again");
            
        return $this->feedService->success(message: "Congrats! your complaince is approved", meta: ['complaince_profile' => $compliance]);       
    }


}