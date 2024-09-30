@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('main')
<div class="main">
  <div class="thanks-card">
    <p class="thanks-card__txt">ご予約ありがとうございます</p>
    <a class="thanks-card__link" href="/">戻る</a>
  </div>
</div>

@endsection