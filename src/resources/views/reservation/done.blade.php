@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('main')

<div class="reservation-complete">
    <h2>ご予約ありがとうございます</h2>
    <button class="back-link"  onclick="window.location='{{ url()->previous() }}';">戻る</button>
</div>

@endsection