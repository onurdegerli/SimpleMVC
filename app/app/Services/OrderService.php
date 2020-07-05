<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Services\MoneyFormatter\BaseMoneyFormatterInterface;
use ReflectionException;

class OrderService
{
    private OrderRepository $orderRepository;
    private CustomerRepository $customerRepository;
    private BaseMoneyFormatterInterface $moneyFormatter;

    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        BaseMoneyFormatterInterface $moneyFormatter
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->moneyFormatter = $moneyFormatter;
    }

    public function getTotalOrderCount(): int
    {
        return $this->orderRepository->getCount();
    }

    public function getTotalRevenue(): string
    {
        return $this->moneyFormatter
            ->format($this->orderRepository->getTotalRevenue());
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