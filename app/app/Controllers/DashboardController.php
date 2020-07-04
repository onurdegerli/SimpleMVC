<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\CustomerService;
use App\Services\OrderService;
use App\Services\Structures\CustomerStructure;
use App\Services\Structures\OrderStructure;
use Core\Exceptions\ViewException;
use Core\Http\Response;
use DI\Container;

class DashboardController
{
    private OrderService $orderService;
    private CustomerService $customerService;

    public function __construct(Container $container)
    {
        $this->orderService = $container->get('OrderService');
        $this->customerService = $container->get('CustomerService');
    }

    /**
     * @return Response
     * @throws ViewException
     */
    public function mainAction(): Response
    {
        $orderStructure = new OrderStructure();
        $customerStructure = new CustomerStructure();

        $orderStructure->totalOrder = $this->orderService->getTotalOrderCount();
        $orderStructure->totalRevenue = $this->orderService->getTotalRevenue();

        $customerStructure->totalCustomer = $this->customerService->getTotalCustomerCount();
dd($orderStructure);
        return (new Response)
            ->responseHtml(
                'dashboard/main',
                []
            );
    }
}