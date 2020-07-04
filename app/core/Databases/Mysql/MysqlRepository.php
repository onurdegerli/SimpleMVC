<?php declare(strict_types=1);

namespace Core\Databases\Mysql;

use Core\Databases\Repository;
use PDO;

class MysqlRepository implements Repository
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(string $table): array
    {
        $sth = $this->db->prepare("SELECT * FROM $table");
        $sth->execute();

        return $sth->fetchAll();
    }
}