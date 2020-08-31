@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
      @foreach ($tasks as $task)
          <li>{!! nl2br(e($task->title)) !!}</li>
      @endforeach
        </div>
      </div>
    </div>
</div>
@endsection
