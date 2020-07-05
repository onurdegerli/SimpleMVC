<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Services\ChartService;
use App\Services\CustomerService;
use App\Services\DateService;
use App\Services\OrderService;
use App\Services\Structures\CustomerStructure;
use App\Services\Structures\OrderStructure;
use Core\Exceptions\ViewException;
use Core\Http\Request;
use Core\Http\Response;
use DI\Container;

class DashboardController
{
    private OrderService $orderService;
    private CustomerService $customerService;
    private CustomerRepository $customerRepository;
    private OrderRepository $orderRepository;
    private DateService $dateService;
    private ChartService $chartService;

    public function __construct(Container $container)
    {
        $this->orderService = $container->get('OrderService');
        $this->customerService = $container->get('CustomerService');
        $this->orderRepository = $container->get('OrderRepository');
        $this->customerRepository = $container->get('CustomerRepository');
        $this->dateService = $container->get('DateService');
        $this->chartService = $container->get('ChartService');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ViewException
     */
    public function mainAction(Request $request): Response
    {
        $from = $request->get['from'] ?? $this->dateService->getOneMonthAgoDate();
        $to = $this->dateService->getLastMomentOfDay($request->get['to'] ?? date('Y-m-d'));

        // TODO: implement some validations...

        $orderStructure = new OrderStructure();
        $orderStructure->totalOrder = $this->orderRepository->getOrderCount($from, $to);
        $orderStructure->totalRevenue = $this->orderService->getTotalRevenue($from, $to);
        $orderStructure->fromDate = $from;
        $orderStructure->toDate = $to;

        $customerStructure = new CustomerStructure();
        $customerStructure->totalCustomer = $this->customerRepository->getCustomerCount($from, $to);

        $groupedOrderData = $this->orderService->getOrdersWithDateMapping($from, $to);
        $groupedCustomerData = $this->customerService->getCustomersWithDateMapping($from, $to);
        $chartStructure = $this->chartService->get(
            [
                [
                    'label' => 'Orders',
                    'data' => $groupedOrderData,
                ],
                [
                    'label' => 'Customers',
                    'data' => $groupedCustomerData,
                ]
            ]
        );

        return (new Response)
            ->responseHtml(
                'dashboard/main',
                [
                    'orderStructure' => $orderStructure,
                    'customerStructure' => $customerStructure,
                    'chartStructure' => $chartStructure,
                ]
            );
    }
}