@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="bg-primary text-white">
        <h1>タスク作成</h1>
        </div>
        <div class="mb-4 text-right">
        <a syle="display: inline-block;" href="/" class="btn btn-secondary">一覧に戻る</a>
        </div>
          <form action="/create" method="post">
            @csrf
            @if ($errors->any())
              @foreach ($errors->all() as $error)
              <div class="alert alert-warning">
              <li>{{ $error }}</li>
              </div>
              @endforeach
            @endif
            <h5>題名</h5>
            <p><input type="text" name="title"></p>
              <h5>期限</h5>
              <p><input type="date" name="limit" /></p>
              <h5>内容</h5>
            <p><textarea name="body" rows="10" cols="80"></textarea></p>
            <p><input type="submit" class="btn btn-primary" value="登録"></p>
          </form>
      </div>
    </div>
</div>
@endsection
