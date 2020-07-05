<?php declare(strict_types=1);

namespace Core\Databases;

use Core\Exceptions\DatabaseException;
use ReflectionClass;
use ReflectionException;

abstract class BaseRepository
{
    public $model = null;
    public ?string $table = null;
    public ?Repository $repository = null;

    public function __construct(Repository $repository)
    {
        if (!$this->model) {
            throw new DatabaseException('Model table not found.');
        }

        $this->table = $this->model::TABLE;

        if (!$this->table) {
            throw new DatabaseException('Table not found or empty.');
        }

        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return object
     * @throws ReflectionException
     */
    public function get(int $id)
    {
        $data = $this->repository->get($this->table, $id);

        return $this->convertToObject($data);
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function getAll()
    {
        $response = [];
        $data = $this->repository->getAll($this->table);
        foreach ($data as $row) {
            $response[] = $this->convertToObject($row);
        }

        return $response;
    }

    public function getCount(array $where = []): int
    {
        return $this->repository->getCount($this->table, $where);
    }

    private function convertToObject(array $array)
    {
        try {
            $r = new ReflectionClass(get_class($this->model));
            $object = $r->newInstanceWithoutConstructor();
            $list = $r->getProperties();
            foreach ($list as $prop) {
                $prop->setAccessible(true);
                if (isset($array[$prop->name])) {
                    $prop->setValue($object, $array[$prop->name]);
                }
            }

            return $object;
        } catch (ReflectionException $e) {
            throw $e;
        }
    }
}