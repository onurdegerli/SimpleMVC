<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Services\MoneyFormatter\Interfaces\MoneyFormatterInterface;
use ReflectionException;

class OrderService
{
    private OrderRepository $orderRepository;
    private CustomerRepository $customerRepository;
    private MoneyFormatterInterface $moneyFormatter;

    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        MoneyFormatterInterface $moneyFormatter
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->moneyFormatter = $moneyFormatter;
    }

    public function getTotalRevenue(string $from, string $to): string
    {
        $totalRevenue = $this->orderRepository->getTotalRevenue($from, $to);

        return $this->moneyFormatter->format($totalRevenue);
    }

    public function getOrdersWithDateMapping($from, $to): array
    {
        $data = $this->orderRepository->getOrdersBetweenDates($from, $to);

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