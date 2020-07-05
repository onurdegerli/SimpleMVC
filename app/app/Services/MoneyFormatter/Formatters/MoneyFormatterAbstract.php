<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Formatters;

class MoneyFormatterAbstract
{
    protected string $locale = 'en_GB';
    protected string $currency = 'EUR';
}