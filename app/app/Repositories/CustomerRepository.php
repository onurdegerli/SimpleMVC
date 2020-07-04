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
}