<?php declare(strict_types=1);

namespace Core\Databases\Postgresql;

use Core\Databases\Repository;
use PDO;

class PostgresqlRepository implements Repository
{
    protected PDO $db;

    protected string $table;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(string $table): array
    {
        return [];
    }
}