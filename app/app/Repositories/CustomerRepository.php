<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;
use Core\Databases\BaseRepository;
use Core\Databases\Repository;
use Core\Exceptions\DatabaseException;

class CustomerRepository extends BaseRepository
{
    /**
     * OrderRepository constructor.
     * @param Repository $repository
     * @throws DatabaseException
     */
    public function __construct(Repository $repository)
    {
        $this->model = new Customer();

        parent::__construct($repository);
    }

    public function getCustomerCount(string $fromDate, string $toDate): int
    {
        $data = $this->repository
            ->customQuery(
                'select count(1) as total from customers where created_at >= :fromDate and created_at <= :toDate',
                [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                ]
            )
            ->one();

        return $data['total'] ?? 0;
    }

    public function getCustomersBetweenDates(string $fromDate, string $toDate)
    {
        return $this->repository
            ->customQuery(
                'SELECT COALESCE(count(1), 0) AS total, DATE(created_at) AS grouped_date 
                        FROM customers 
                        WHERE created_at >= :fromDate and created_at <= :toDate
                        GROUP BY grouped_date',
                [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                ]
            )
            ->all();
    }
}