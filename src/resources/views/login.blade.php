@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')
<div class="login-container">
  <div class="login-body">
    <div class="login-body__main">
      <h2 class="main-ttl">Login</h2>
    </div>
    <div class="login-form">
      <form action="/login" method="post">
        @csrf
        <div class="input-form">
          <span><i class="fas fa-envelope"></i></span>
          <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
          @error('email')
          <p>{{ $message }}</p>
          @enderror
        </div>
        <div class="input-form">
          <span><i class="fas fa-lock"></i></span>
          <input type="password" placeholder="Password" name="password">
          @error('password')
          <p>{{ $message }}</p>
          @enderror
        </div>
        <div class="submit-btn">
          <input type="submit" value="ログイン" onclick="location.href='/login'">
        </div>
      </form>
    </div>
  </div>
</div>

@endsection