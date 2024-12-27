@component('mail::message')
# メールアドレスを認証してください

Reseのご利用ありがとうございます。

現在のアカウントは仮登録の状態です。

以下のボタンをクリックして、アカウントのメールアドレスを認証してアカウントの本登録をしてください。

@component('mail::button', ['url' => $actionUrl])
メールアドレスを認証する
@endcomponent

もしこのメールに心当たりがない場合は、無視してください。

よろしくお願いいたします。  
@endcomponent
