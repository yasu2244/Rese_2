<h1>QRコード</h1>
<p>予約ID: {{ $reservation->id }}</p>
<p>来店日時: {{ $reservation->date }} {{ $reservation->time }}</p>
<div>
    <h2>QRコード</h2>
    {!! $qr_code !!}
</div>
<a href="{{ route('mypage') }}" class="btn">戻る</a>
