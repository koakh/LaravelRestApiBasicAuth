@extends('layouts.app')

@section('content')

  <h1>Task List Faker</h1>
  <p class="lead">Here's a list of all faker data.
  <hr>

  {{--
  {{ phpinfo() }}
  --}}

  @foreach($users as $user)
    <h4>{{ $user->name }}</h4>
    <p>{{ $user->email }}</p>
    <p>{{ $user->user }}</p>
    <p>{{ $user->password }}</p>
  @endforeach

@stop
