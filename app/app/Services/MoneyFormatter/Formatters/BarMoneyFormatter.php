<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Formatters;

use App\Services\MoneyFormatter\Interfaces\MoneyFormatterInterface;

class BarMoneyFormatter implements MoneyFormatterInterface
{
    public function format(float $number): string
    {
        return str_replace('.', ',', $number);
    }
}