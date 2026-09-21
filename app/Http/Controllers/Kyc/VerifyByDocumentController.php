<?php

namespace App\Http\Controllers\Kyc;


use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Domains\Identity\DTO\VerifyDocumentData;
use App\Http\Requests\Kyc\VerifyByDocumentRequest;
use App\Domains\Kyc\Actions\VerificationLevelTwoAction;
use App\Enums\Kyc\KycDocumentType;

class VerifyByDocumentController extends Controller
{
    public function __construct(protected VerificationLevelTwoAction $action) {}
    public function __invoke(VerifyByDocumentRequest $request): JsonResponse
    {
        $kyc = $this->action->execute($request->user()->kyc, new VerifyDocumentData(
            type: $request->enum('type', KycDocumentType::class),
            documentNumber: $request->string('document_number')->toString(),
            surname: $request->input('surname'),
            filePath: $request->file('file')?->getRealPath(),
        ));
        return ApiResponse::success(data: $kyc, message: 'KYC document verification submitted successfully.');
    }
}
