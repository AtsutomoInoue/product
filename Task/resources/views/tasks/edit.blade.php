@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 style="display:inline">タスク編集</h1>
        <a syle="display: inline-block;" href="/" class="btn btn-secondary mb-4 text-left">一覧に戻る</a>
          <form action="/edit/{{ $task->id }}" method="post">
            @csrf
            @method('PUT')
            @if ($errors->any())
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif
            <p>題名(入力必須)：<input type="text" name="title" value="{{ $task->title }}"></p>
              <h5>期限</h5>
              <p><input type="date" name="limit" value="{{ $task->limit }}"/></p>
              <h5>内容</h5>
            <p><textarea name="body" rows="10" cols="50">{{ $task->body }}</textarea></p>
            <p><input type="submit" class="btn btn-primary" value="更新"></p>
          </form>
      </div>
    </div>
</div>
@endsection
