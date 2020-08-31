@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>タスク管理表</h1>
        <div class="card">
      @foreach ($tasks as $task)
      <a href="/{{ $task ->id }}">
        <li>{!! nl2br(e($task->title)) !!}</li></a>
      @endforeach
        </div>
      </div>
    </div>
</div>
@endsection
