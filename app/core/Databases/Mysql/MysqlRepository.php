<?php declare(strict_types=1);

namespace Core\Databases\Mysql;

use Core\Databases\Helpers;
use Core\Databases\Repository;
use PDO;
use PDOStatement;

class MysqlRepository implements Repository
{
    protected PDO $db;
    private PDOStatement $stmt;

    use Helpers;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(string $table): array
    {
        $stmt = $this->db->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt->fetchAll();
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
        $this->stmt = $this->db->prepare($query);
        $this->stmt->execute($params);

        return $this;
    }

    public function one()
    {
        return $this->stmt->fetch();
    }

    public function all()
    {
        return $this->stmt->fetchAll();
    }
}