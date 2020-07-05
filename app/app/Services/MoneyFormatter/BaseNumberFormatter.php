<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter;

use NumberFormatter;

class BaseNumberFormatter extends MoneyFormatterAbstract implements BaseMoneyFormatterInterface, MoneyFormatterInterface
{
    public function setLocale(string $locale): MoneyFormatterInterface
    {
        $this->locale = $locale;

        return $this;
    }

    public function setCurrency(string $currency): MoneyFormatterInterface
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