@extends('master')

@section('content')
  <h1 class="ui header">You're Logged Out!</h1>

  <p>I don't know anything about you. Please click on the following
  link to proceed with the login.</p>

  <p><a href="{{ $login_url }}">Login with Geekie</a></p>
@endsection
