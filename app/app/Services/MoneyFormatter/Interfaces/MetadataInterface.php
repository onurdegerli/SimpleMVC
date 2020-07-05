<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Interfaces;

interface MetadataInterface
{
    public function setLocale(string $locale): MetadataInterface;
    public function setCurrency(string $currency): MetadataInterface;
}