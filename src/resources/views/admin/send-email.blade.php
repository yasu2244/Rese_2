@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/send-email.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>お知らせメール送信</h1>
    <form action="{{ route('admin.send_email.send') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="subject">件名</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
            @error('subject')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="message">本文</label>
            <textarea id="message" name="message" rows="15">{{ old('message') }}</textarea>
            @error('message')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="button-group">
            <button type="submit" class="btn btn-submit">送信</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-back">戻る</a>
        </div>
    </form>
</div>
@endsection

