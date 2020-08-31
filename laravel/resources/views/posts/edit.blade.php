@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="border mb-4">
      <h1 class="h1 mb-4">
        編集
      </h1>
         <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}">
          @csrf
          @method('PUT')
          <fieldset class="mb-4">
            <div class="form-group">
              <label for="title">題名</label>
                <input
                type="text"
                name="title"
                id="title"
                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                value="{{ old('title') ?: $post->title }}">
                @if($errors->has('title'))
                <div class="invalid-feedback">
                  {{ $errors->first('title') }}
                </div>
                @endif
            </div>

            <div class="form-group">
              <label for="body">
                本文
              </label>
              <textarea
                name="body"
                id="body"
                class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                rows="4">
                {{ old('body') ?: $post->body }}
              </textarea>
                @if($errors->has('body'))
                  <div class="invalid-feedback">
                    {{ $errors->first('body') }}
                  </div>
                @endif
              </div>

        <div class="mt-5">
          <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post]) }}">キャンセル</a>
          <button type="submit" class="btn btn-primary">投稿</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
@endsection
