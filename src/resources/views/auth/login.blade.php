@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
<div class="main">
  <form class="auth-card" action="/login" method="post">
    @csrf
    <div class="auth-card__ttl">Login</div>
    <div class="auth-card__item">
      <img class="auth-card__item__img" src="/img/email.png" alt="email-icon" width="25px" />
      <input class="auth-card__item__input" type="email" placeholder="Email" name="email" />
    </div>
      @error('email')
      <p class="error-message">{{ $message }}</p>
      @enderror
    <div class="auth-card__item">
      <img class="auth-card__item__img" src="/img/password.png" alt="password-icon" width="25px" />
      <input class="auth-card__item__input" type="password" placeholder="Password" name="password" />
    </div>
      @error('password')
      <p class="error-message">{{ $message }}</p>
      @enderror
    <div class="auth-card__btn">
      <input type="submit" value="ログイン" />
    </div>
  </form>
</div>
@endsection