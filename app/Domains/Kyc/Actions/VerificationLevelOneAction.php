<?php 

namespace App\Domains\Kyc\Actions;

use App\Enums\Kyc\KycLevel;
use App\Enums\Kyc\KycStatus;
use App\Domains\Identity\Models\Kyc;
use App\Domains\Identity\Models\KycVerification;
use App\Domains\Identity\DTO\VerifyLevelOneData;
use App\Domains\Kyc\Services\BvnSelfieVerificationService;
use App\Enums\Kyc\KycVerificationType;

class VerificationLevelOneAction 
{
    public function __construct(protected BvnSelfieVerificationService $service) {}

    public function execute(Kyc $kyc, VerifyLevelOneData $dto ) : KycVerification
    {
        $verification = $kyc->verification()->create([
            'level'         => KycLevel::LEVEL_1,
            'type'          => KycVerificationType::BVN,
            'provider'      => 'dojah',
            'status'        => KycStatus::PENDING
        ]);

        $response = $this->service->verifyBvnWithSelfie([
            'bvn'       => $dto->bvn,
            'selfie'    => $dto->selfie
        ]);

        $verification->update([
            'status' => KycStatus::VERIFIED,
            'response_payload' => $response->json(),
            'verified_at' => now(),
        ]);

        return $verification;
    }
}