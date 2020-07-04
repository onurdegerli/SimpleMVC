<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Device;
use App\Repositories\DeviceRepository;
use Core\Exceptions\DatabaseException;
use ReflectionException;

class DeviceService
{
    private DeviceRepository $customerRepository;

    public function __construct(DeviceRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return Device[]
     * @throws DatabaseException
     * @throws ReflectionException
     */
    public function getAll(): array
    {
        return $this->customerRepository->getAll();
    }

    /**
     * @param int $orderId
     * @return Device
     * @throws DatabaseException
     * @throws ReflectionException
     */
    public function get(int $orderId): Device
    {
        return $this->customerRepository->get($orderId);
    }
}