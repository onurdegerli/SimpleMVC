<?php declare(strict_types=1);

namespace Core\Databases\Mysql;

use Core\Databases\Helpers;
use Core\Databases\Repository;
use PDO;

class MysqlRepository implements Repository
{
    protected PDO $db;

    use Helpers;

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

    public function get(string $table, int $id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function getCount(string $table, array $where = []): int
    {
        $query = "SELECT 1 FROM $table";
        if ($where) {
            $query .= ' WHERE ' . $this->getFields($where);
        }
        $stmt = $this->db->prepare($query);

        $stmt->execute($where);

        return $stmt->rowCount();
    }

    public function customQuery(string $query, array $params = [])
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetch();
    }
}