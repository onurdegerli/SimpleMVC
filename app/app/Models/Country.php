<?php declare(strict_types=1);

namespace App\Models;

class Country
{
    public const TABLE = 'countries';

    public int $id;
    public string $name;
}