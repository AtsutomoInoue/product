<?php use Carbon\Carbon; ?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 style="display:inline">タスク詳細</h1>
        <a syle="display: inline-block;" href="/" class="btn btn-primary mb-4 text-left">一覧に戻る</a>
        <div class="mb-4 text-right">
          <form action="/{{ $task->id }}" method="post">
            @method( 'DELETE' )
            @csrf
        <a href="/edit/{{ $task->id }}" class="btn btn-secondary">編集</a>
          <button type="submit" class="btn btn-danger" onclick="return confirm('削除します。宜しいですか？')" >削除</button>
        </form>
        </div>
        @if(strtotime(Carbon::now()->toDateString()) > strtotime($task->limit))
        <h4 class="bg-danger text-dark">期日超過です。処理してください。<br>
        @elseif(strtotime(Carbon::now()->toDateString()) == strtotime($task->limit))
        <h4 class="bg-warning text-dark">期日です。<br>
        @endif
          <div class="card">
            <h1>題名：{{ $task->title }}</h1>
            <h5>期限：{{ $task->limit }}</h5>
            <h5>状態：{{$process->process_name }}</h5>
            <hr>
            <p>{!! nl2br(e($task->body)) !!}</p>
        </div>
      </div>
    </div>
</div>
@endsection
