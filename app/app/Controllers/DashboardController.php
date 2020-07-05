<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\CustomerRepository;
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
    private CustomerRepository $customerRepository;

    public function __construct(Container $container)
    {
        $this->orderService = $container->get('OrderService');
        $this->customerRepository = $container->get('CustomerRepository');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ViewException
     */
    public function mainAction(Request $request): Response
    {
        $from = $request->get['from'] ?? $this->orderService->getOneMonthAgoDate();
        $to = $request->get['to'] ?? date('Y-m-d');

        // TODO: implement some validations...

        $orderStructure = new OrderStructure();
        $orderStructure->totalOrder = $this->orderService->getTotalOrderCount($from, $to);
        $orderStructure->totalRevenue = $this->orderService->getTotalRevenue($from, $to);
        $orderStructure->fromDate = $from;
        $orderStructure->toDate = $to;

        $customerStructure = new CustomerStructure();
        $customerStructure->totalCustomer = $this->customerRepository->getCount();

        return (new Response)
            ->responseHtml(
                'dashboard/main',
                [
                    'orderStructure' => $orderStructure,
                    'customerStructure' => $customerStructure,
                ]
            );
    }
}