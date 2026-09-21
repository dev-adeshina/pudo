<?php 

namespace App\Domains\Kyc\Actions;

use Throwable;
use App\Enums\Kyc\KycLevel;
use App\Enums\Kyc\KycStatus;
use App\Enums\Kyc\KycDocumentType;
use App\Domains\Identity\Models\Kyc;
use App\Domains\Identity\Models\KycDocument;
use App\Domains\Identity\DTO\VerifyDocumentData;
use App\Domains\Kyc\Services\DocumentVerificationService;


class VerificationLevelTwoAction 
{
    public function __construct(protected DocumentVerificationService $service){}

    public function execute(Kyc $kyc, VerifyDocumentData $dto) : KycDocument
    {
        $document = $kyc->documents()->create([
            'type'              => $dto->type,
            'document_number'   => $dto->documentNumber,
            'country'           => 'NG',
            'provider'          => 'dojah',
            'status'            => KycStatus::PENDING,
        ]);

        try{
            $response = match ($dto->type) {
                KycDocumentType::DRIVERS_LICENSE => $this->service->verifyDriverLicense($dto->documentNumber),
                KycDocumentType::VOTERS_CARD => $this->service->verifyVotersCard($dto->documentNumber),
                KycDocumentType::PASSPORT => $this->service->verifyPassport($dto->documentNumber),
                KycDocumentType::NATIONAL_ID => $this->service->verifyNationalId($dto->documentNumber),
                KycDocumentType::NIN_SLIP => $this->service->verifyNinSlip($dto->documentNumber),
            };

            if ($response->successful()) {

                $document->update([
                    'status' => KycStatus::VERIFIED,
                    'provider_response' => $response->json(),
                    'verified_at' => now(),
                ]);

                $kyc->update([
                    'current_level' => KycLevel::LEVEL_2,
                    'status' => KycStatus::VERIFIED,
                    'verified_at' => now(),
                ]);

                return $document;
            }

            $document->update([
                'status' => KycStatus::FAILED,
                'provider_response' => $response->json(),
                'failure_reason' => $response->body(),
            ]);

            return $document;
        }catch(Throwable $e){ 
             
            $document->update([
                'status'            => KycStatus::FAILED,
                'failure_reason'    => $e->getMessage()
            ]);
            throw $e; 
        }
       
    }
}