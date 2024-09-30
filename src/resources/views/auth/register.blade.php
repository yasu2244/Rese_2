@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
<main class="main">
  <form class="auth-card" action="/register" method="post">
    @csrf
    <div class="auth-card__ttl">Registration</div>
    <div class="auth-card__item">
      <img class="auth-card__item__img" src="/img/username.png" alt="username-icon" width="25px" />
      <input class="auth-card__item__input" type="text" placeholder="Username" name="name" />
    </div>
      @error('name')
      <p class="error-message">{{ $message }}</p>
      @enderror
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
    <div class="auth-card__item">
      <img class="auth-card__item__img" src="/img/password.png" alt="password-icon" width="25px" />
      <input class="auth-card__item__input" type="password" placeholder="password_confirmation" name="password_confirmation" />
    </div>
      @error('passpassword-confirmationword')
      <p class="error-message">{{ $message }}</p>
      @enderror
    <div class="auth-card__btn">
      <input type="submit" value="登録" />
    </div>
  </form>
</main>
@endsection