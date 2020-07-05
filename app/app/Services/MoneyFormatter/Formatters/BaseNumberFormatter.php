<?php declare(strict_types=1);

namespace App\Services\MoneyFormatter\Formatters;

use App\Services\MoneyFormatter\Interfaces\BaseMoneyFormatterInterface;
use App\Services\MoneyFormatter\Interfaces\MoneyFormatterInterface;
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