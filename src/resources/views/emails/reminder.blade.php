<!DOCTYPE html>
<html>
<head>
    <title>本日のご予約のお知らせ</title>
</head>
<body>
    <h1>本日のご予約</h1>
    <p>以下のご予約があります。</p>
    <p><strong>店舗名:</strong> {{ $reservation->shop->name }}</p>
    <p><strong>日時:</strong> 
        {{ $reservation->date->format('Y年m月d日') }} {{ $reservation->time->format('H:i') }}
    </p>

    <p>お越しをお待ちしております！</p>
    <a href="{{ route('shop.detail', ['shop_id' => $reservation->shop->id]) }}" 
       style="
           color: #FFF; 
           background-color: #007BFF; 
           padding: 10px 15px; 
           text-decoration: none; 
           border-radius: 5px;
           display: inline-block;
           margin-bottom: 20px; 
       ">
       店舗の詳細を見る
    </a>
    <br>
</body>
</html>