<?php declare(strict_types=1);

namespace App\Services\Structures;

class OrderStructure
{
    public ?int $totalOrder = null;
    public ?string $totalRevenue = null;
    public string $fromDate;
    public string $toDate;
}