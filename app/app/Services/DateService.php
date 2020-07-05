<?php

namespace App\Services;

class DateService
{
    public function getOneMonthAgoDate(): string
    {
        return date('Y-m-d', strtotime(date('Y-m-d') . " - 1 month"));
    }

    public function getLastMomentOfDay(string $day): string
    {
        return date($day . ' 23:59:59');
    }
}