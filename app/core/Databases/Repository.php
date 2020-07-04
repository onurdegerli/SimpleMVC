<?php declare(strict_types=1);

namespace Core\Databases;

interface Repository
{
    public function getAll(string $table): array;
}