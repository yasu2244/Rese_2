@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/send-email.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>お知らせメール送信</h1>
    <form action="{{ route('admin.send_email.send') }}" method="post">
        @csrf
        <div>
            <label for="subject">件名</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div>
            <label for="message">本文</label>
            <textarea id="message" name="message" rows="15" required></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
</div>
@endsection
