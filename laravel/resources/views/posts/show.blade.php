@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="border p-4">
      <a class="btn btn-secondary" href="{{ route('posts.index') }}">戻る</a>
      <div class="mb-4 text-right">
        <form syle="display: inline-block;" action="{{ route('posts.destroy',['post'=>$post]) }}"
         method="post">
         @csrf
         @method('DELETE')
        <a class="btn btn-primary" href="{{ route('posts.edit',['post'=>$post])}}">編集する</a>
         <button class="btn btn-danger">削除する</button>
        </form>
      </div>

      <h1 class="h4 mb-4">題名：{{ $post->title }}</h1>
      <h1 class="h5 mb-4">名前：{{ $post->name }}
        投稿時間：{{ $post->created_at->format('Y年m月d日 H時i分s秒') }}</h1>
      <p class="mb-5">{!! nl2br(e($post->body))!!}</p>

      <section>
        <h1 class="h2 mb-4">コメント</h1>
          <form class="mb-4" action="{{ route('comments.store') }}" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" name="name" class="form-control
              {{ $errors->has('name') ? 'is-invalid' : '' }}">
              @if($errors->has('name'))
              <div class="invalid-feedback">
                {{ $errors->first('name')}}
              </div>
             @endif

              <label for="body">本文</label>
              <textarea name="body" rows="4"
               class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">
               {{ old('body') }}</textarea>
               @if($errors->has('body'))
               <div class="invalid-feedback">
                 {{ $errors->first('body')}}
               </div>
              @endif
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">
                コメントする
              </button>
            </div>
          </form>

          <h2><p>コメント一覧</p></h2>
          @forelse($post->comments as $comment)
          <div class="border-top p-4">
            <p class="mt-2">名前：{{ $comment->name }}
            <time class="text-secondary">
              投稿日：{{ $comment->created_at->format('Y年m月d日 H時i分s秒')}}
            </time></p>
            <p class="mt-2">{!! nl2br(e($comment->body)) !!}</p>
          </div>
          @empty
          <p>コメントはありません。</p>
          @endforelse

      </section>
    </div>
  </div>
@endsection
