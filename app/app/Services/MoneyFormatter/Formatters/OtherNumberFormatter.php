<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Formatters;

use App\Services\MoneyFormatter\Interfaces\BaseMoneyFormatterInterface;

class OtherNumberFormatter implements BaseMoneyFormatterInterface
{
    public function format(float $number): string
    {
        return str_replace('.', ',', $number);
    }
}