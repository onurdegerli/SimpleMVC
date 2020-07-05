<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Formatters;

use App\Services\MoneyFormatter\Interfaces\MoneyFormatterInterface;
use App\Services\MoneyFormatter\Interfaces\MetadataInterface;
use NumberFormatter;

class FooMoneyFormatter extends MoneyFormatterAbstract implements MoneyFormatterInterface, MetadataInterface
{
    public function setLocale(string $locale): MetadataInterface
    {
        $this->locale = $locale;

        return $this;
    }

    public function setCurrency(string $currency): MetadataInterface
    {
        $this->currency = $currency;

        return $this;
    }

    public function format(float $number): string
    {
        $formatter = new NumberFormatter($this->locale,   NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($number, $this->currency);
    }
}