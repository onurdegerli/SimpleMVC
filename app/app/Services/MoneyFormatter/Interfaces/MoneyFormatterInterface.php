<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Interfaces;

interface MoneyFormatterInterface
{
    public function format(float $number): string;
}