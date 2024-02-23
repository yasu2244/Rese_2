@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('main')

<div class="mypage-container">
    <div class="reservation-section">
        <h3>予約状況</h3>
        <div class="reservation-card">
            <i class="fas fa-clock"></i>
            <span>予約ナンバー: 123</span>
            <button class="delete-button">削除</button>
            <div class="reservation-info">
                <span>ショップ名: サンプル店</span>
                <span>日にち: 2024-02-15</span>
                <span>時間: 12:00</span>
                <span>人数: 2</span>            
            </div>
        </div>
    </div>
    <div class="user-favorites-section">
        <h2>testさん</h2>
        <h3>お気に入り店舗</h3>
        <div class="favorite-cards">
            <div class="favorite-card">
                <img src="" alt="Restaurant Image">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
            <div class="favorite-card">
                <img src="" alt="Restaurant Image">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
            <div class="favorite-card">
                <img src="" alt="Restaurant Image">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
            <div class="favorite-card">
                <img src="" alt="Restaurant Image">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
            <div class="favorite-card">
                <img src="" alt="Restaurant Image">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection