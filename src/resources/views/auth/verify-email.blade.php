@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('main')
<div class="container">
    <h1>メール確認が必要です</h1>
    <p>登録したメールアドレスに送信されたリンクをクリックして</br>
        認証を完了してください。</p>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            新しい認証リンクが送信されました。
        </div>
    @endif

    <p>メールが届かない場合は、下記リンクをクリックして再送信してください。</p>
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">認証メールを再送信</button>
    </form>
</div>
@endsection
