<?php declare(strict_types=1);

namespace Core\Databases;

/**
 * Class Connection
 * @package Core\Databases
 */
abstract class Connection
{
    abstract public function get(): Database;
}