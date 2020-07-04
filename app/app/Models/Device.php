<?php declare(strict_types=1);

namespace App\Models;

class Device
{
    public const TABLE = 'devices';

    public int $id;
    public string $name;
}