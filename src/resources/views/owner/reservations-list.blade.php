@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/reservations-list.css') }}">
@endsection

@section('main')
<div class="main">
    <div class="resrve-list__header">
        <a class="resrve-list__link" href="/owner/dashboard">＜</a>
        <h2 class="reseve-list__ttl">予約状況リスト</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>店舗名</th>
                <th>予約者</th>
                <th>予約日</th>
                <th>予約時間</th>
                <th>人数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->shop->name }}</td>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->date }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->time)->format('H時i分') }}</td>
                <td>{{ $reservation->user_num }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
