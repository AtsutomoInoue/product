@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1>{{ __('メニュー') }}</h1></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <p><a href="{{ url('/cyclings')}}">サイクリングに行った所</a></p>
                    <p><a href="{{ url('/plamodels')}}">作ったプラモデルの一覧</a></p>
                    <p><a href="{{ url('/changepassword')}}">パスワードの変更</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
