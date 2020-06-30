<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\OrderService;
use Core\Exceptions\ViewException;
use Core\Http\Response;
use DI\Container;

class DashboardController
{
    private OrderService $orderService;

    public function __construct(Container $container)
    {
        $this->orderService = $container->get('OrderService');
    }

    /**
     * @return Response
     * @throws ViewException
     */
    public function mainAction(): Response
    {
        return (new Response)
            ->responseHtml(
                'dashboard/main',
                []
            );
    }
}