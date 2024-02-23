@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('main')
<div class="regiser-container">
  <div class="register-body">
    <div class="register-body__main">
      <h2 class="main-ttl">Registration</h2>
    </div>
    <div class="register-form">
      <form action="/register" method="post">
        @csrf
        <div class="input-form">
          <span><i class="fas fa-user"></i></span>
          <input type="text" placeholder="Username" name="name" value="{{ old('name') }}">
          @error('name')
          <p>{{ $message }}</p>
          @enderror
        </div>
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
          <input type="submit" value="登録" onclick="location.href='/thanks'">
        </div>
      </form>
    </div>
  </div>
</div>

@endsection