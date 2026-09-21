<?php 

namespace App\Domains\Identity\DTO;

final readonly class VerifyLevelOneData 
{
    public function __construct(
        public string $bvn,
        public string $selfie,
    ) {}
}