@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>タスク詳細</h1>
        <a href="/" class="btn btn-primary">戻る</a>
        <div class="card">
      <p>{{ $task->title }}</p>
      <p>{{ $task->body }}</p>
        </div>
      </div>
    </div>
</div>
@endsection
