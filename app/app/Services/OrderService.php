<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use ReflectionException;

class OrderService
{
    private OrderRepository $orderRepository;
    private CustomerRepository $customerRepository;

    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
    }

    public function getTotalOrderCount(): int
    {
        return $this->orderRepository->getCount();
    }

    public function getTotalRevenue(): float
    {
        return $this->orderRepository->getTotalRevenue();
    }

    /**
     * @param string|null $from
     * @param string|null $to
     * @return int
     */
    public function getTotalByDate(string $from = null, string $to = null): int
    {
        return $this->orderRepository->getCount();
    }

    /**
     * @param int $orderId
     * @return Order
     * @throws ReflectionException
     */
    public function get(int $orderId): Order
    {
        return $this->orderRepository->get($orderId);
    }
}