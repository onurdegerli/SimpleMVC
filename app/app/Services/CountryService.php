<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Country;
use App\Repositories\CountryRepository;
use Core\Exceptions\DatabaseException;
use ReflectionException;

class CountryService
{
    private CountryRepository $customerRepository;

    public function __construct(CountryRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return Country[]
     * @throws DatabaseException
     * @throws ReflectionException
     */
    public function getAll(): array
    {
        return $this->customerRepository->getAll();
    }

    /**
     * @param int $orderId
     * @return Country
     * @throws DatabaseException
     * @throws ReflectionException
     */
    public function get(int $orderId): Country
    {
        return $this->customerRepository->get($orderId);
    }
}