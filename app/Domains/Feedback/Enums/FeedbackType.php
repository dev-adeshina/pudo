<?php 

namespace App\Domains\Feedback\Enums;

enum FeedbackType: string 
{
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';
    case INFO = 'info';
    
}