<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
      //index.blade.phpファイルをレスポンスする
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
}
