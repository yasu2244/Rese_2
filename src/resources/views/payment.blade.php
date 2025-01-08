@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('main')
@if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
        @csrf
        <label for="amount">金額 (円):</label>
        <input type="number" name="amount" id="amount" required>

        <div id="card-element"></div>
        <button type="submit">支払う</button>
    </form>
@endsection

@section('scripts')
<script src="{{ asset('js/payment.js') }}"></script>
@endsection