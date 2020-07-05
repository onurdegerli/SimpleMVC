<?php declare(strict_types=1);

namespace App\Services;

use App\Repositories\DeviceRepository;

class DeviceService
{
    private DeviceRepository $customerRepository;

    public function __construct(DeviceRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
}