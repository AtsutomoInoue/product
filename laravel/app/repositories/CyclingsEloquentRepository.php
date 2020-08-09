<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Cycling;

class CyclingsEloquentRepository implements CyclingsRepositoryInterface
{
    public function all(): array
    {
        return Cycling::All()->toArray();
    }

    public function get(int $id): array
    {
        return Cycling::where('id', $id)->first()->toArray();
    }

    public function insert(string $place, string $address, string $comment): void
    {
        $cyclings = new Cycling;
        $cyclings->place = $place;
        $cyclings->address = $address;
        $cyclings->comment = $comment;
        $cyclings->save();
    }

    public function update(int $id, string $place, string $address, string $comment): void
    {
        $cyclings = Cycling::find($id);
        $cyclings->place = $place;
        $cyclings->address = $address;
        $cyclings->comment = $comment;
        $cyclings->save();
    }

    public function delete(int $id): void
    {
        $cyclings = Cycling::find($id);
        $cyclings->delete();
    }
}
