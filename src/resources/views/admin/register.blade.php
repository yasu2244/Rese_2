@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('main')

<div class="regiser-container">
  <div class="register-body">
    <div class="register-body__main">
      <h2 class="main-ttl">Admin_Registration</h2>
    </div>
    <div class="register-form">
      <form action="{{ route('admin.register') }}" method="post">
        @csrf
        <div class="input-form">
          <span><i class="fas fa-user"></i></span>
          <input type="text" placeholder="Username" name="name" value="{{ old('name') }}">
        </div>
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="input-form">
          <span><i class="fas fa-envelope"></i></span>
          <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
        </div>
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
        <div class="input-form">
          <span><i class="fas fa-lock"></i></span>
          <input type="password" placeholder="Password" name="password">
        </div>
        @error('password')
        <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="submit-btn">
          <input type="submit" value="登録">
        </div>
      </form>
    </div>
  </div>
</div>

@endsection