@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>タスク作成</h1>
        <div class="mb-4 text-right">
        <a syle="display: inline-block;" href="/" class="btn btn-secondary">一覧に戻る</a>
        </div>
          <form action="/create" method="post">
            @csrf
            <p>題名：<input type="text" name="title"></p>
              @if ($errors->any())
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
              @endif
            <p><textarea name="body" rows="10" cols="50"></textarea></p>
            <p><input type="submit" class="btn btn-primary" value="登録"></p>
          </form>
      </div>
    </div>
</div>
@endsection
