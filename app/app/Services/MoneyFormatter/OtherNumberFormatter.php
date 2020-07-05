<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter;

class OtherNumberFormatter implements BaseMoneyFormatterInterface
{
    public function format(float $number): string
    {
        return str_replace('.', ',', $number);
    }
}