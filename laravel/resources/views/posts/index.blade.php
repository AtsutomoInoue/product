@extends('layouts.app')

@section('content')
    <div class="container mt-4">
      <h1 class="h1 mb-4">掲示板</h1>
        <div class="mb-4">
          <a href="{{ url('../home') }}" class="btn btn-secondary">トップページへ</a>
          <a href="{{ route('posts.create')}}" class="btn btn-primary">新規投稿する</a>
        </div>
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                  題名：{{ $post->title }}
                  名前：{{ $post->name }}
                </div>
                <div class="card-body">
                    <p class="card-text">{!! nl2br(e(Str::limit($post->body, 200))) !!}</p>
                    <a class="card-ling" href="{{ route('posts.show',['post' => $post ])}}">続きを読む</a>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時：{{ $post->created_at->format('Y年m月d日 H時i分s秒') }}
                    </span>
                    @if ($post->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $post->comments->count() }}件
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mb-5">
          {!! $posts->render() !!}
        </div>
    </div>
@endsection
