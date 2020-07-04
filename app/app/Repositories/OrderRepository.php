<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use Core\Databases\BaseRepository;
use Core\Databases\Repository;
use Core\Exceptions\DatabaseException;

class OrderRepository extends BaseRepository
{
    /**
     * OrderRepository constructor.
     * @param Repository $repository
     * @throws DatabaseException
     */
    public function __construct(Repository $repository)
    {
        $this->model = new Order();

        parent::__construct($repository);
    }

    public function getTotalRevenue(): float
    {
        $data = $this->repository
            ->getCustomQuery(
                'select sum(oi.quantity * i.price) as total 
                        from order_items oi 
                        join items i on oi.item_id = i.id
                        join orders o on oi.order_id = o.id
                        where o.id = :id',
                [
                    'id' => 3
                ]
            );

        return $data['total'] ?? 0;
    }
}