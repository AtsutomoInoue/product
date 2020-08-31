@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="border mb-4">
      <h1 class="h1 mb-4">
        新規投稿
      </h1>
        <form action="{{ route('posts.store') }}" method="post">
          @csrf
          <fieldset class="mb-4">
            <div class="form-group">
              <label for="title">題名</label>
                <input type="text" name="title"
                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                value="{{ old('title')}}">
                @if($errors->has('title'))
                <div class="invalid-feedback">
                  {{ $errors->first('title') }}
                </div>
                @endif
            </div>

            <div class="form-group">
              <label for="name">名前</label>
                <input type="text" name="name"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                value="{{ old('name')}}">
                @if($errors->has('name'))
                  <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                  </div>
                @endif
            </div>

                <div class="form-group">
                  <label for="body">
                    本文
                  </label>
                  <textarea name="body" class="form-control {{
                    $errors->has('body') ? 'is-invalid' : '' }}"
                    rows="4">{{ old('body') }}</textarea>
                  @if($errors->has('body'))
                    <div class="invalid-feedback">
                      {{ $errors->first('body') }}
                    </div>
                  @endif
                </div>

                <div class="mt-5">
                  <a class="btn btn-secondary" href="{{ route('posts.index') }}">キャンセル</a>
                  <button type="submit" class="btn btn-primary">投稿</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
@endsection
