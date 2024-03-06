@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('main')
<div class="thanks-container">
    <h2>会員登録ありがとうございます</h2>
    <a class="transition-link" href="/login">ログインする</a>
</div>

@endsection