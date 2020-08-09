<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Plamodel;

class PlamodelsEloquentRepository implements PlamodelsRepositoryInterface
{
    public function all(): array
    {
        return Plamodel::All()->toArray();
    }

    public function get(int $id): array
    {
        return Plamodel::where('id', $id)->first()->toArray();
    }

    public function insert(string $name, string $maker, int $price,
    int $released, string $point, string $comment): void
    {
        $plamodel = new Plamodel;
        $plamodel->name = $name;
        $plamodel->maker = $maker;
        $plamodel->price = $price;
        $plamodel->released = $released;
        $plamodel->point = $point;
        $plamodel->comment = $comment;
        $plamodel->save();
    }

    public function update(int $id, string $name, string $maker, int $price,
    int $released, string $point, string $comment): void
    {
        $plamodel = Plamodel::find($id);
        $plamodel->name = $name;
        $plamodel->maker = $maker;
        $plamodel->price = $price;
        $plamodel->released = $released;
        $plamodel->point = $point;
        $plamodel->comment = $comment;
        $plamodel->save();
    }

    public function delete(int $id): void
    {
        $plamodel = Plamodel::find($id);
        $plamodel->delete();
    }
}
