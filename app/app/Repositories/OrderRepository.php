<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use PDO;

class OrderRepository extends BaseRepository
{
    public function __construct(PDO $db)
    {
        $this->table = Order::TABLE_NAME;

        parent::__construct($db);
    }
}