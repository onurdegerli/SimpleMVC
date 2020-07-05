<?php declare(strict_types=1);

namespace App\Models;

class Order
{
    public const TABLE = 'orders';

    public int $id;
    public int $country_id;
    public int $device_id;
    public int $purchase_at;
}