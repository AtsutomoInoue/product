@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>新規追加</h1></div>
        <p><a href="{{ route('plamodels.index')}}">一覧画面へ戻る</a></p>

        @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @endif

        <form class="" action="{{ route('plamodels.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <div>
            <p>名前<input type="text" class="form-control" name="name" value="{{old('name')}}"></p>
            </div>
          </div>
          <div class="form-group">
            <div>
              <p>メーカー<input type="text" class="form-control" name="maker" value="{{old('maker')}}"></p>
            </div>
          </div>
          <div class="form-group">
            <div>
              <p>価格（税抜き）<input type="text" class="form-control" name="price" value="{{old('price')}}"></p>
            </div>
          </div>
          <div class="form-group">
            <div>
              <p>発売年月<input type="text" class="form-control" name="released" value="{{old('released')}}"></p>
            </div>
          </div>
          <div class="form-group">
            <div>
              <p>おすすめポイント<input type="text" class="form-control" name="point" value="{{old('point')}}"></p>
            </div>
          </div>
          <div class="form-group">
            <div>
                <p>コメント<textarea name="comment" class="form-control" value="{{old('comment')}}"></textarea></p>
            </div>
          </div>
          <input type="submit" name="" value="登録する">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
