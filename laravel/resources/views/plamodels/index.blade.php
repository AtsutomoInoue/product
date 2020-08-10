@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>作ったプラモデルの一覧</h1></div>
        <a href="{{ url('../home') }}">トップページへ</a>
        <br>
        @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
        @endif
        <br>
        <p>サイクリング同様、CRUDでの実装で、部分検索も実装しています。</p>
        <p>自分が作ったプラモデルをデータベースにしています。</p>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <form class="form-inline" action="{{ route('plamodels.create')}}" method="get">
                @csrf
                <input type="submit" class="btn btn-info" value="新規追加">
              </form>
            </div>
          </div>
        </div>
        <!-- 部分検索 -->
        <p>任意の文字を入力することで検索が可能です。名前・メーカーを入力すると検索できます。</p>
        <p>空欄のまま検索すると全件表示されます。</p>
        <div class="row">
          <div class="col-sm-12">
            <form class="form-inline" action="{{url('plamodels')}}" method="get">
              <div class="form-group">
                <label>検索</label>
                <input type="text" name="keyword" class="form-control" value="{{$keyword ?? ''}}">
              </div>
              <input type="submit" class="btn btn-info" value="検索">
            </form>
          </div>
        </div>

@if($plamodels->count())
        <table border="1" class="col-md-11" cellpadding="3">
          <tr align="center">
            <th>名前</th>
            <th>詳細</th>
          </tr>
          @foreach ($plamodels as $plamodel)
          <tr>
            <td>{{ $plamodel->name }}</td>
            <th>
              <form class="form-inline" action="{{ route('plamodels.show',$plamodel->id)}}" method="get">
                @csrf
                <input type="submit" class="btn btn-info" value="詳細">
              </form>
            </th>
          </tr>
          @endforeach
        </table>
        {{ $plamodels->render() }}
        @else
        <p>見つかりませんでした。</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
