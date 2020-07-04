<?php declare(strict_types=1);

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAll(): array
    {
        return $this->orderRepository->getAll();
    }
}