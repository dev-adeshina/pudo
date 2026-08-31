<?php 

namespace App\Domains\Feedback\Services;

use App\Domains\Feedback\DTOs\FeedbackMessage;
use App\Domains\Feedback\Enums\FeedbackType;

class FeedbackService
{
    public function success(string $message, array $meta = []): FeedbackMessage
    {
        return new FeedbackMessage($message, FeedbackType::SUCCESS, $meta);
    }


    public function warning(string $message, array $meta = []): FeedbackMessage
    {
        return new FeedbackMessage($message, FeedbackType::WARNING, $meta);
    }


    public function error(string $message, array $meta = []): FeedbackMessage
    {
        return new FeedbackMessage($message, FeedbackType::ERROR, $meta);
    }


    public function info(string $message, array $meta = []): FeedbackMessage
    {
        return new FeedbackMessage($message, FeedbackType::INFO, $meta);
    }



}