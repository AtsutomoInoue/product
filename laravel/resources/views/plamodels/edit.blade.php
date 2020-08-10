@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>編集</h1></div>
        
          @if ($errors->any())
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form class="" action="{{ route('plamodels.update', $plamodels->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <div>
                <p>名前<input type="text" class="form-control" name="name" value="{{ $plamodels->name }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
            <p>メーカー<input type="text" class="form-control" name="maker" value="{{ $plamodels->maker }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
            <p>価格<input type="text" class="form-control" name="price" value="{{ $plamodels->price }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
            <p>発売年月<input type="text" class="form-control" name="released" value="{{ $plamodels->released }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
            <p>おすすめポイント<input type="text" class="form-control" name="point" value="{{ $plamodels->point }}"></p>
              </div>
            </div>
            <div class="form-group">
              <div>
                <p>コメント：<textarea name="comment" class="form-control">{{ $plamodels->comment }}</textarea></p>
              </div>
            </div>
          <div class="form-group row mb-2">
            <div class="col-md-8 offset-md-4">
              <div style="display:inline-flex">
                  <input type="submit" class="btn btn-info" value="編集する">
                </form>
                <a class="btn btn-link" href="{{ route('plamodels.index') }}">
                  キャンセル
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
