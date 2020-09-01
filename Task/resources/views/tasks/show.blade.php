@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 style="display:inline">タスク詳細</h1>
        <a syle="display: inline-block;" href="/" class="btn btn-primary mb-4 text-left">一覧に戻る</a>
        <div class="mb-4 text-right">
        <a href="/edit/{{ $task->id }}" class="btn btn-secondary">編集</a>
        </div>
          <div class="card">
            <h1>{{ $task->title }}</h1>
            <hr>
            <p>{!! nl2br(e($task->body)) !!}</p>
        </div>
      </div>
    </div>
</div>
@endsection
