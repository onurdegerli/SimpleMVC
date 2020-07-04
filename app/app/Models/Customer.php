<?php declare(strict_types=1);

namespace App\Models;

class Customer
{
    public const TABLE = 'customers';

    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
}