@extends('layouts.app')

@section('content')
<div class="container">

      <div class="col-md-8">
        <h1>タスク管理表</h1>
        <a href="/create" class="btn btn-primary">新規作成</a>
        <div class="card">
          <h2>タスク名</h2>
      @foreach ($tasks as $task)
      <a href="/{{ $task ->id }}">
        <h3>{{ $task->title }}</h3></a>
        <hr>
      @endforeach
        </div>
      </div>

</div>
@endsection
