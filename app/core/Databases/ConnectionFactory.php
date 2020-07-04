<?php

namespace Core\Databases;

use Core\Databases\Mysql\Mysql;
use Core\Databases\Postgresql\Postgresql;
use Core\Exceptions\DatabaseException;

/**
 * Class ConnectionFactory
 * @package Core\Databases
 */
class ConnectionFactory
{
    public static function get(string $type): Database
    {
        if ($type === 'mysql') {
            return new Mysql();
        }

        if ($type === 'postgresql') {
            return new Postgresql();
        }

        throw new DatabaseException('No database type specified.');
    }
}