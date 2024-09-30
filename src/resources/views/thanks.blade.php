@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('main')
<div class="main">
  <div class="thanks-card">
    <p class="thanks-card__txt">会員登録ありがとうございます</p>
    <a class="thanks-card__link" href="/login">ログインする</a>
  </div>
</div>

@endsection