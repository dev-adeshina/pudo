<?php 

namespace App\Domains\Feedback\DTOs;
use Override;
use Stringable;
use App\Domains\Feedback\Enums\FeedbackType;

class FeedbackMessage implements Stringable
{
    public function __construct(
        public readonly string $message, 
        public readonly FeedbackType $type,
        public readonly array $meta = []
        ){}

    #[Override]
    public function __toString(): string
    {
        return $this->message;
    }
}