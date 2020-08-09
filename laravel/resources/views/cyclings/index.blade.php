@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>サイクリングで行った所</h1></div>
        <a href="{{ url('../home') }}">トップページへ</a>
        <br>
        @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
        @endif
        <br>
        <p>CRUD実装に使ったもので、サイクリングで行ってきた場所やお店を纏めています。</p>
        <p>また、部分検索も実装しています</p>
        <form class="form-inline" action="{{ route('cyclings.create')}}" method="get">
          @csrf
          <input type="submit" class="btn btn-info" value="新規追加">
        </form>
        <!-- 部分検索 -->
        <p>任意の文字を入力することで検索が可能です。場所と住所が該当となります。</p>
        <p>また、空欄のまま検索すると全件表示されます。</p>
        <div class="row">
          <div class="col-sm-12">
            <form class="form-inline" action="{{url('cyclings')}}" method="get">
              <div class="form-group">
                <label>検索</label>
                <input type="text" name="keyword" class="form-control" value="{{$keyword ?? ''}}">
              </div>
              <input type="submit" class="btn btn-info" value="検索">
            </form>
          </div>
        </div>

@if($cyclings->count())
        <table border="1" width="500" cellpadding="3">
          <tr align="center">
            <th>場所</th>
            <th>詳細</th>
            <th>編集</th>
            <th>削除</th>
          </tr>
          @foreach ($cyclings as $cycling)
          <tr>
            <td>{{ $cycling->place }}</td>
            <th>
              <form class="form-inline" action="{{ route('cyclings.show',$cycling->id)}}" method="get">
                @csrf
                <input type="submit" class="btn btn-info" value="詳細">
              </form>
            </th>
            <th>
              <form class="form-inline" action="{{ route('cyclings.edit',$cycling->id)}}" method="get">
                @csrf
                <input type="submit" class="btn btn-info" value="編集">
              </form>
            </th>
            <th>
              <form class="" action="{{ route('cyclings.destroy', $cycling->id)}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-info" value="削除">
              </form>
            </th>
          </tr>
          @endforeach
        </table>
        {{ $cyclings->render() }}
        @else
        <p>見つかりませんでした。</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
