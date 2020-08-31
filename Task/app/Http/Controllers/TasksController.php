<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
      //index.blade.phpファイルをレスポンスする
      $tasks = Task::all();
      return view('tasks.index',['tasks' => $tasks]);
    }
}
