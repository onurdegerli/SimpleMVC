<?php declare(strict_types=1);

namespace Core\Dependency;

use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Core\Databases\ConnectionFactory;
use Core\Exceptions\DatabaseException;
use DI\Container;
use DI\ContainerBuilder;

/**
 * Class Dependency
 * @package Core\Dependency
 *
 * TODO: This is the only 3rd party application is installed.
 * Also. it is possible to implement a self-made DI-container.
 */
class Dependency
{
    /**
     * @return Container
     * @throws DatabaseException
     */
    public function run(): Container
    {
        $builder = new ContainerBuilder();
        $container = $builder->build();

        $databaseConnection = (new ConnectionFactory())->get(getenv('DB_CONNECTION'));
        $container->set(
            'db',
            $databaseConnection::getInstance(
                getenv('DB_HOST'),
                getenv('DB_DATABASE'),
                getenv('DB_USER'),
                getenv('DB_PASSWORD')
            )
        );

        $container->set(
            'OrderService',
            function () use ($container) {
                return new OrderService(new OrderRepository($container->get('db')));
            }
        );

        return $container;
    }
}