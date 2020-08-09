@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>編集</h1></div>
          <p><a href="{{ route('cyclings.index')}}">一覧画面へ戻る</a></p>

          @if ($message = Session::get('success'))
          <p>{{ $message }}</p>
          @endif

          @if ($errors->any())
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form class="" action="{{ route('cyclings.update', $cyclings->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <div>
                <p>場所：<input type="text" class="form-control" name="place" value="{{ $cyclings->place }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
            <p>アクセス：<input type="text" class="form-control" name="address" value="{{ $cyclings->address }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
                <p>コメント：<textarea name="comment" class="form-control">{{ $cyclings->comment }}</textarea></p>
              </div>
            </div>
            <input type="submit" name="" value="編集する">
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
