<?php 

namespace App\Domains\Shared\Enums;

enum ApiStatus: string
{
    case SUCCESS = 'success';
    case OK = 'ok';
    case NOT_FOUND = '404';
}