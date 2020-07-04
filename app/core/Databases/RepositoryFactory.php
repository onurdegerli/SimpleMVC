<?php

namespace Core\Databases;

/**
 * Class RepositoryFactory
 * @package Core\Databases
 */
class RepositoryFactory
{
    public static function get(Database $databaseConnection): Repository
    {
        return $databaseConnection->getRepository();
    }
}