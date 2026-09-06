<?php 

namespace App\Enums;

enum LanguageEnum: string
{
    case EN = 'en';
    case ES = 'es';
    case FR = 'fr';
    case DE = 'de';
    case IT = 'it';
    case PT = 'pt';
    case RU = 'ru';
    case ZH = 'zh';
    case JA = 'ja';
    case KO = 'ko';

    public static function getAll(): array
    {
        return array_map(fn($language) => $language->value, self::cases());
    }
}