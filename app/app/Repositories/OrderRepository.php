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

    public function getOrdersBetweenDates(string $fromDate, string $toDate): array
    {
        return $this->repository
            ->customQuery(
                'SELECT IFNULL(count(1), 0) AS total, DATE(purchase_at) AS grouped_date 
                        FROM orders 
                        WHERE purchase_at >= :fromDate and purchase_at <= :toDate
                        GROUP BY grouped_date',
                [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                ]
            )
            ->all();
    }

    public function getOrderCount(string $fromDate, string $toDate): int
    {
        $data = $this->repository
            ->customQuery(
                'select count(1) as total from orders where purchase_at >= :fromDate and purchase_at <= :toDate',
                [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                ]
            )
            ->one();

        return $data['total'] ?? 0;
    }

    public function getTotalRevenue(string $fromDate, string $toDate): float
    {
        $data = $this->repository
            ->customQuery(
                'select sum(oi.quantity * i.price) as total 
                        from order_items oi 
                        join items i on oi.item_id = i.id
                        join orders o on oi.order_id = o.id
                        where o.purchase_at >= :fromDate and o.purchase_at <= :toDate',
                [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                ]
            )
            ->one();

        return $data['total'] ?? 0;
    }
}