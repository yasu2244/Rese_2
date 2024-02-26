@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('main')

<div class="reservation-complete">
    <h2>ご予約ありがとうございます</h2>
    <a class="back-link" href="{{ $previousUrl }}">戻る</a>
</div>

@endsection