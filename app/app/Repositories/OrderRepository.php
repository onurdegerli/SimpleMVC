<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use Core\Databases\BaseRepository;
use Core\Databases\Repository;

class OrderRepository extends BaseRepository
{
    public function __construct(Repository $repository)
    {
        $this->table = Order::TABLE_NAME;

        parent::__construct($repository);
    }
}