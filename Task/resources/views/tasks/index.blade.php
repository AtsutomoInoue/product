<?php use Carbon\Carbon; ?>
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>タスク管理表</h1>
        本日は{{ Carbon::now()->toDateString() }}です。
        <a href="/create" class="btn btn-primary">新規作成</a>
        <div class="card">
          <h2>タスク名</h2>
          <hr>
      @foreach ($tasks as $task)
      <a href="/{{ $task ->id }}">
        @if(strtotime(Carbon::now()->toDateString()) > strtotime($task->limit))
        <h4 class="bg-danger text-dark">期日超過です。処理してください。<br>
        {{ $task->title }}</h4></a>
        @elseif(strtotime(Carbon::now()->toDateString()) == strtotime($task->limit))
        <h4 class="bg-warning text-dark">期日です。<br>
        {{ $task->title }}</h4></a>
        @else
        <h3>{{ $task->title }}</h3></a>
        @endif
        <hr>
      @endforeach
        </div>
      </div>
  </div>
</div>
@endsection
