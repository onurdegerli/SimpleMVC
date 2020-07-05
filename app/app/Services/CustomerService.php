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

    public function getCustomersWithDateMapping($from, $to): array
    {
        $data = $this->customerRepository->getCustomersBetweenDates($from, $to);

        return array_flatten(
            array_map(
                static function ($row) {
                    return [$row['grouped_date'] => $row['total']];
                },
                $data
            )
        );
    }
}