@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('main')
<div class="main">
  <div class="thanks-card">
    <p class="thanks-card__txt">投稿ありがとうございます</p>
    <a class="thanks-card__link" href="/">ホームへ戻る</a>
  </div>
</div>

@endsection