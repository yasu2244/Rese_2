@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')

<div class="login-container">
  <div class="login-body">
    <div class="login-body__main">
      <h2 class="main-ttl">ManagerLogin</h2>
    </div>
    <div class="login-form">
      <form action="/manager/login" method="post">
        @csrf
        <div class="input-form">
          <span><i class="fas fa-envelope"></i></span>
          <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
        </div>
          @error('email')
          <p class="error-message">{{ $message }}</p>
          @enderror
        <div class="input-form">
          <span><i class="fas fa-lock"></i></span>
          <input type="password" placeholder="Password" name="password">
        </div>
          @error('password')
          <p class="error-message">{{ $message }}</p>
          @enderror
        <div class="submit-btn">
          <input type="submit" value="ログイン">
        </div>
      </form>
    </div>
  </div>
</div>

@endsection