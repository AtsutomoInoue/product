<?php
declare(strict_types=1);

namespace App\Repositories;

interface CyclingsRepositoryInterface
{
    public function all(): array;

    public function get(int $id): array;

    public function insert(string $place, string $address, string $comment): void;

    public function update(int $id, string $place, string $address, string $comment): void;

    public function delete(int $id): void;
}
