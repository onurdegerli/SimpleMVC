<?php declare(strict_types=1);

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService
{
    private CountryRepository $customerRepository;

    public function __construct(CountryRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
}