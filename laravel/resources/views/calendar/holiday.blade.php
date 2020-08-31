@extends('layouts.app')
@section('content')
    <h1>休日設定</h1>
    <a href="{{ url('home')}}">戻る</a>
    <script>
      $( function(){
        $("#day").datepicker({dateFormat: 'yy-mm-dd'});
      });
    </script>
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="/holiday" method="post">
      <div class="form-group">
      {{csrf_field()}}
      <label for="day">日付 [YYYY-MM-DD]</label>
      <input type="text" name="day" class="form-control" id="day" value="{{$data->day}}">
      <label for="description">説明</label>
      <input type="text" name="description" class="form-control" id="description" value="{{$data->description}}">
      </div>
      <button type="submit" class="btn btn-primary">登録</button>
      <input type="hidden" name="id" value="{{$data->id}}">
    </form>
      <table class="table">
        <thead>
        <tr>
          <th>日付</th>
          <th>説明</th>
          <th>作成日</th>
          <th>更新日</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $val)
          <tr>
            <th scope="row"><a href="{{url('/holiday/'.$val->id)}}">{{$val->day}}</a></th>
            <td>{{$val->description}}</td>
            <td>{{$val->created_at}}</td>
            <td>{{$val->updated_at}}</td>
          <td><form action="/holiday" method="post">
            <input type="hidden" name="id" value="{{$val->id}}">
            {{ method_field('delete') }}
            {{csrf_field()}}
            <button class="btn btn-default" type="submit" name="button">削除</button>
          </form></td>
          </tr>
        @endforeach
        </tbody>
      </table>
@endsection
