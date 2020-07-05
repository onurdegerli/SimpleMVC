<?php declare(strict_types=1);

namespace Core\Dependency;

use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Services\ChartService;
use App\Services\CustomerService;
use App\Services\DateService;
use App\Services\MoneyFormatter\Formatters\BaseNumberFormatter;
use App\Services\OrderService;
use Core\Databases\ConnectionFactory;
use Core\Databases\RepositoryFactory;
use Core\Exceptions\DatabaseException;
use DI\Container;
use DI\ContainerBuilder;

/**
 * Class Dependency
 * @package Core\Dependency
 *
 * TODO: Implement a dependency injection container.
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

        $databaseRepository = (new RepositoryFactory())->get($databaseConnection);

        $container->set(
            'OrderRepository',
            function () use ($databaseRepository) {
                return new OrderRepository($databaseRepository);
            }
        );

        $container->set(
            'CustomerRepository',
            function () use ($databaseRepository) {
                return new CustomerRepository($databaseRepository);
            }
        );

        $container->set(
            'OrderService',
            function () use ($container) {
                return new OrderService(
                    $container->get('OrderRepository'),
                    $container->get('CustomerRepository'),
                    new BaseNumberFormatter()
                );
            }
        );

        $container->set(
            'CustomerService',
            function () use ($container) {
                return new CustomerService($container->get('CustomerRepository'));
            }
        );

        $container->set(
            'DateService',
            function () {
                return new DateService();
            }
        );

        $container->set(
            'ChartService',
            function () {
                return new ChartService();
            }
        );

        return $container;
    }
}