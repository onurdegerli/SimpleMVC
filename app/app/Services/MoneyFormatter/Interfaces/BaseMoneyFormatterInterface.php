<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Interfaces;

interface BaseMoneyFormatterInterface
{
    public function format(float $number): string;
}