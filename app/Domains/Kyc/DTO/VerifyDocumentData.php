<?php 

namespace App\Domains\Identity\DTO;

use App\Enums\Kyc\KycDocumentType;

final readonly class VerifyDocumentData 
{

    public function __construct(
        public KycDocumentType $type,
        public string $documentNumber,
        public ?string $surname = null,
        public ?string $filePath = null,
    ) {}

}