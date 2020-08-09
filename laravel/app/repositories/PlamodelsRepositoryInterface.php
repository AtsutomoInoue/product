<?php
declare(strict_types=1);

namespace App\Repositories;

interface PlamodelsRepositoryInterface
{
    public function all(): array;

    public function get(int $id): array;

    public function insert(string $name, string $maker, int $price, int $released, string $point, string $comment): void;

    public function update(int $id, string $name, string $maker, int $price, int $released, string $point, string $comment): void;

    public function delete(int $id): void;
}
