<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Interfaces;

interface MoneyFormatterInterface
{
    public function setLocale(string $locale): MoneyFormatterInterface;
    public function setCurrency(string $currency): MoneyFormatterInterface;
}