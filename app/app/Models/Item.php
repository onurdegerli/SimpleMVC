<?php declare(strict_types=1);

namespace App\Models;

class Item
{
    public const TABLE = 'items';

    public int $id;
    public int $ean;
    public float $price;
}