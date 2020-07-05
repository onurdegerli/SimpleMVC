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
                'SELECT COUNT(1) AS total, DATE(purchase_at) AS grouped_date 
                        FROM orders 
                        WHERE purchase_at >= :fromDate AND purchase_at <= :toDate
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
                'SELECT COUNT(1) AS total 
                        FROM orders 
                        WHERE purchase_at >= :fromDate AND purchase_at <= :toDate',
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
                'SELECT SUM(oi.quantity * i.price) AS total 
                        FROM order_items oi 
                        JOIN items i ON oi.item_id = i.id
                        JOIN orders o ON oi.order_id = o.id
                        WHERE o.purchase_at >= :fromDate AND o.purchase_at <= :toDate',
                [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                ]
            )
            ->one();

        return $data['total'] ?? 0;
    }
}