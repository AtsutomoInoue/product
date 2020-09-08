<?php
declare(strict_types=1);

 namespace App\Repositories;

  interface TasksRepositoryInterface
 {
   public function all(): array;

   public function get(int $id): array;

   public function insert(string $title,string $body, int $limit, int $process_id): void;

   public function update(int $id,string $title,string $body, int $limit, int $process_id): void;

   public function delete(int $id): void;
 }
