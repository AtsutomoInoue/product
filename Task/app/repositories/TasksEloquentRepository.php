<?php
declare(strict_types=1);

namespace App\Repositories;
use Illuminate\Support\Facades\Date;

use App\Task;

class TasksEloquentRepository implements TasksRepositoryInterface
{
    public function all(): array
    {
        return Task::All()->toArray();
    }

    public function get(int $id): array
    {
        return Task::where('id', $id)->first()->toArray();
    }

    public function insert(string $title,string $body, int $limit, int $process_id): void
    {
        $task = new Task;
        $task->title = $title;
        $task->body = $body;
        $task->limit = $limit;
        $task->process_id = $process_id;
        $task->save();
    }

    public function update(int $id,string $title,string $body,int $limit, int $process_id): void
    {
        $task = Task::find($id);
        $task->title = $title;
        $task->body = $body;
        $task->limit = $limit;
        $task->process_id = $process_id;
        $task->save();
    }

    public function delete(int $id): void
    {
        $task = Task::find($id);
        $task->delete();
    }
}
