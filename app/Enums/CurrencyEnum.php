<?php 

namespace App\Enums;

enum CurrencyEnum: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case JPY = 'JPY';
    case AUD = 'AUD';
    case CAD = 'CAD';
    case CHF = 'CHF';
    case CNY = 'CNY';
    case SEK = 'SEK';
    case NZD = 'NZD';
    case NGN = 'NGN';

    public static function getAll(): array
    {
        return array_map(fn($currency) => $currency->value, self::cases());
    }
}