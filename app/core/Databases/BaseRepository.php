<?php

declare(strict_types=1);

namespace Core\Databases;

use Core\Exceptions\DatabaseException;

abstract class BaseRepository
{
    public ?string $table = null;
    private ?Repository $repository = null;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        if (!$this->table) {
            throw new DatabaseException('Table not found or empty.');
        }

        return $this->repository->getAll($this->table);
    }
}