@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}"> <!-- 必要に応じて管理者用のCSSを用意 -->
@endsection

@section('main')
<div class="main">
  <form class="auth-card" action="{{ route('admin.login') }}" method="post"> <!-- URLを管理者用に変更 -->
    @csrf
    <div class="auth-card__ttl">Admin Login</div> <!-- タイトルを変更 -->
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
