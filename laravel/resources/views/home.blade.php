@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @include('menu')
      <div class="col-md-12">
        <div class="card">
        @include('calendar.index')
        </div>

        </div>
    </div>
</div>
@endsection
