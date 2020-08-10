@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"><h1>詳細画面</h1></div>
        <p><a href="{{ route('plamodels.index')}}">一覧画面へ戻る</a></p>
        <!-- カラムの値を抽出して其々をテーブルに格納する -->
        <div class="container-fluid">
        <table border="1" align="center" class="col-md-11">
          <tr>
            <th>名前</th>
            <th>メーカー</th>
            <th>価格（税抜き）</th>
            <th>発売年月（YYYYMM）</th>
          </tr>
          <tr>
            <td>{{ $plamodels -> name }}</td>
            <td>{{ $plamodels -> maker }}</td>
            <td>{{ $plamodels -> price }}円</td>
            <td>{{ $plamodels -> released }}</td>
          </tr>
          <!-- 注目ポイントとコメント欄は其々段を下げて見やすいように
                段分けし、colspanで結合する -->
          <th colspan="4">注目ポイント</th>
          <tr>
            <td colspan="4">{{ $plamodels -> point }}</td>
          </tr>
          <th colspan="4">コメント</th>
          <tr>
            <!-- コメント欄は改行を含めるのでnl2brを使用 -->
            <td colspan="4">{!! nl2br(e($plamodels -> comment)) !!}</td>
          </tr>
          <th colspan="3">
            <form class="form-inline" action="{{ route('plamodels.edit', $plamodels->id)}}" method="get">
              @csrf
              <input type="submit" class="btn btn-info" value="編集">
            </form>
          </th>
          <th colspan="2">
            <form class="" action="{{ route('plamodels.destroy', $plamodels->id)}}" method="post">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-info"value="削除" onclick="delete_alert(event);return false;">
            </form>
          </th>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection
