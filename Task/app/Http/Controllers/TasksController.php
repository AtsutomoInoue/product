<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
      $tasks = Task::all();
      return view('tasks.index',['tasks' => $tasks]);
    }

    public function show(int $id)
    {
      $task = Task::findOrFail($id);
      return view('tasks.show',['task' => $task]);
    }

    public function create()
    {
      return view('tasks.create');
    }

    public function store(Tasks $request)
    {
      Task::create($request->all());

      return redirect('/');
    }

    public function edit(int $id)
    {
      $task = Task::findOrFail($id);
      return view('tasks.edit', ['task' => $task]);
    }

    public function update(Tasks $request, $id)
    {
      $task = Task::findOrFail($id);

      $task->update($request->all());

      return redirect('/' . $task->id);
    }

    public function delete(int $id)
    {
      Task::destroy($id);
      return redirect('/');
    }
}
