<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Device;
use Core\Databases\BaseRepository;
use Core\Databases\Repository;
use Core\Exceptions\DatabaseException;

class DeviceRepository extends BaseRepository
{
    /**
     * OrderRepository constructor.
     * @param Repository $repository
     * @throws DatabaseException
     */
    public function __construct(Repository $repository)
    {
        $this->model = new Device();

        parent::__construct($repository);
    }
}