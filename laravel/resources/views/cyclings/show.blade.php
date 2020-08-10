@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"><h1>詳細画面</h1></div>
        <p><a href="{{ route('cyclings.index')}}">一覧画面へ戻る</a></p>
        <!-- カラムの値を抽出して其々をテーブルに格納する -->
        <div class="container-fluid">
        <table border="1" align="center" class="col-md-11">
          <tr>
            <th>場所</th>
            <th>アクセス</th>
            <th>作成日時</th>
            <th>更新日時</th>
          </tr>
          <tr>
            <td>{{ $cyclings->place }}</td>
            <td>{{ $cyclings->address }}</td>
            <td>{{ $cyclings->created_at }}</td>
            <td>{{ $cyclings->updated_at }}</td>
          </tr>
          <!-- コメント欄は段を下げて見やすいようにcolspanで結合する -->
          <th colspan="4">コメント</th>
          <tr>
            <!-- コメント欄は改行を含めるのでnl2brを使用 -->
            <td colspan="4">{!! nl2br(e($cyclings->comment)) !!}</td>
          </tr>
          <th colspan="3">
            <form class="form-inline" action="{{ route('cyclings.edit', $cyclings->id)}}" method="get">
              @csrf
              <input type="submit" class="btn btn-info" value="編集">
            </form>
          </th>
          <th colspan="2">
            <form class="" action="{{ route('cyclings.destroy', $cyclings->id)}}" method="post">
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
