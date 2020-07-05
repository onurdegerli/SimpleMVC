<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter;

interface BaseMoneyFormatterInterface
{
    public function format(float $number): string;
}