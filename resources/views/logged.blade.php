@extends('master')

@section('content')
  <h1 class="ui header">You're Logged In!</h1>

  <p>I now know your name: <strong>{{ $name }}</strong></p>

  <p>To log out, please click the link below:</p>

  <p><a href="/logout">Logout</a></p>
@endsection
