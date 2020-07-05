<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Services\MoneyFormatter\Interfaces\BaseMoneyFormatterInterface;
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

    public function getTotalOrderCount(string $from, string $to): int
    {
        return $this->orderRepository->getTotalOrderCount($from, $to);
    }

    public function getTotalRevenue(string $from, string $to): string
    {
        $totalRevenue = $this->orderRepository->getTotalRevenue($from, $to);

        return $this->moneyFormatter->format($totalRevenue);
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

    public function getOneMonthAgoDate(): string
    {
        return date('Y-m-d', strtotime(date('Y-m-d') . " - 1 month"));
    }
}