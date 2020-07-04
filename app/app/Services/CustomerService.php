<?php declare(strict_types=1);

namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getTotalCustomerCount(): int
    {
        return $this->customerRepository->getCount();
    }
}