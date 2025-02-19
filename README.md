# Rese
飲食店予約サービス
![Rese2_home](https://github.com/user-attachments/assets/e58b2523-28d0-41bc-8dde-3791f33b9e0e)

## 作成した目的
webアプリケーション開発の学習のため

## アプリケーションURL
・開発(ローカル)環境<br />
http://localhost<br />
・本番(EC2)環境<br />
https://ec2-54-238-90-144.ap-northeast-1.compute.amazonaws.com/<br />

## 機能一覧

### 一般ユーザーの機能
・会員登録/ログイン/ログアウト/マイページ<br />
未ログイン時に画像のメニューロゴから会員登録とログインフォームへ移動できる。<br />
ログイン時にはログアウトとマイページへのリンクが表示される。

![Rese_menu](https://github.com/yasu2244/Rese/assets/76992290/3dfa8092-f6bd-4f6e-a493-f637421e3452)

・ソート機能と検索機能<br />
ソート機能欄で評価高い順、または低い順で並び替えができる。<br />
search欄ではエリア又はジャンルのプルダウンメニューで選択、または店名を検索するとリアルタイム検索できる。

![sort&search](https://github.com/user-attachments/assets/9f7b1ab7-fa1b-46f0-8e17-f672e1e6da63)

・飲食店詳細ページ表示<br />
トップページの各飲食店の詳しく見るから詳細ページへ移動できる。<br />

・飲食店予約情機能<br />
飲食店詳細ページから予約フォームにより予約が可能。
<br />
・飲食店お気に入り追加<br />
ログイン時にトップページでハートアイコンを押すことにより<br />
グレーのハートアイコンが赤に変化しマイページへその飲食店の情報が追加される。<br />

・飲食店お気に入り削除<br />
赤色のハートアイコンを押すとグレーになりマイページから削除される。<br />
マイページで削除した場合はページの更新が必要。<br />

・ユーザーの飲食店予約情報取得/変更/削除<br />
マイページで予約フォームで予約した内容を確認できる。<br />
×ボタンで削除、予約変更ボタンで変更用のフォームのページへ遷移する。<br />

・レビュー機能<br />
飲食店詳細ページでログイン時のみレビューを送信できる。<br />
5段階の星マーク(必須)とコメントを送ることができる。<br />
一人一回送ることができる。<br />
送られた星マークは平均値が算出され、トップページの各飲食店ごとに表示される。<br />

・レビューの一覧/編集/削除<br />
上記で送った星マークとコメントはマイページの「投稿したレビュー」ボタンで<br />
確認でき、編集ボタンを押すと編集ページへ遷移し削除ボタンで削除できる。<br />

・支払い<br />
未払いの会計をマイページから精算できる(クレジットカード決済)<br />
QRコードのページもありますがクレジットカード決済に繋がります。<br />

### 管理者の機能
・管理者のログインフォーム  
/admin-owner-loginで管理者と店舗代表者の専用ログインフォームへアクセスできる。

・店舗代表者一覧<br />
店舗の代表者をリストで確認できる<br />
そしてそのページで各店舗代表者の担当店舗の確認と編集が行える。

・店舗代表者の作成<br />
店舗代表者の作成ができる。店舗の登録は店舗代表者一覧ページの編集から行ってください。<br />
  
・お知らせメール送信<br />
ユーザー登録者にお知らせメールを送ることができる<br />

### 店舗代表者の機能
・店舗代表者のログインフォーム  
/admin-owner-loginで管理者と店舗代表者の専用ログインフォームへアクセスできる。<br />

・店舗の作成
店舗情報を入力して店舗を作成できる。<br />

・店舗の一覧
担当する店舗のリストを閲覧できる。編集ボタンを押すと店舗情報を編集することができる。<br />

・予約状況の確認
現在予約されている担当店舗の予約状況を確認できる。

## 使用技術（実行環境）
・開発フレームワーク<br />
  PHP: 7.3<br />
  Laravel: 8.40<br />
  Stripe<br />
  qrコード生成<br />
・仮想サーバ<br />
  EC2 (開発環境・本番環境)<br />
・データベース<br />
  RDS (本番環境のみ)<br />
・ストレージ<br />
  s3（本番環境のみ）<br />

## テーブル設計
![tabledata1](https://github.com/user-attachments/assets/05a43ff9-b7c6-47b0-98e2-34aff0e24813)
![tabledata2](https://github.com/user-attachments/assets/88ddeb98-92d5-4143-8262-ee4cd8e984bd)
![tabledata3](https://github.com/user-attachments/assets/05d5b210-bd68-46ed-be6d-418a9e82b50d)

## ER図
![Rese_er](https://github.com/user-attachments/assets/cff04f8a-cf3a-49c5-a840-53736d8d3313)

##環境構築
ローカル環境下においてのテスト環境構築手順を示します。
作業ディレクトリにgithubのリポジトリをcloneします。
```
git clone https://github.com/yasu2244/Rese_2.git
```
cloneしたRese2の直下ディレクトリに移動してDockerを起動します。
```
docker-compose up -d --build
```
phpコンテナにログインします。
```
docker-compose exec php bash
```
composerをインストールします・
```
composer install
```
データベースに接続するために、.env.exampleファイルをコピーして.envファイルを作成します。
```
cp .env.example .env
```
作成ができたら.envファイルの11行目以降を以下のように修正します。
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
phpコンテナ内でアプリケーションの暗号キーの作成、テーブルとダミーデータの作成を行います。
```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan db:seed
```
次にメール機能を使用するため.envファイル31行目以降を修正します。今回はgmailを使用しています。
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail_address@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_gmail_address@gmail.com
MAIL_FROM_NAME="Reseサポート"
```
your_gmail_address@gmail.comにはご自身のgamilアドレスを設定してください。<br />
MAIL_PASSWORDについて<br />
* Googleアカウントにログインします。
* Googleアカウントのセキュリティ設定ページ に移動します。
* 「2段階認証プロセス」を有効にします。
* 「アプリ パスワード」を選択し、メールに使用するパスワードを生成します。
* 「アプリ パスワード」が表示されない場合は検索欄から探してください。
* 生成されたパスワードを .env の MAIL_PASSWORD に設定します。<br />
この時スベースがあるとエラーになるので注意してください。(正しい例: aaaabbbbccccdddd)<br />
これでユーザー登録をした際認証メールが送信されます。

次にストレージのシンボリックリンクを作成。画像が正常に表示されます。
```
php artisan storage:link
```
リマインダー機能の確認
* /src/app/Http/Kernel.php内に毎朝8時に通知を送るように設定してあります。<br />
お好みで時間を変更してください。
```
protected function schedule(Schedule $schedule)
{
    $schedule->command('reminders:send')->dailyAt('08:00');
}
```
* リマインダー機能のテストの方法
ログインした後に予約を作成し、phpコンテナ内で以下のコマンドを実行すると<br />
登録したアドレスにメールが送信されます。
```
php artisan tinker
```
```
$reservation = \App\Models\Reservation::find(1);
```
```
$user = $reservation->user;
```
```
$user->notify(new \App\Notifications\TodayReservationReminder($reservation));
```
Stripeの実装
まずStripeのアカウントを作成し、APIキーを取得する必要があります。<br />
### 1. Stripeアカウントの作成
1. [Stripe公式サイト](https://dashboard.stripe.com/register) にアクセスし、新規アカウントを作成。
2. ダッシュボードにログイン。

### 2. APIキーの取得
1. Stripeダッシュボードで「開発者」→「APIキー」に移動。
2. 公開可能キー（Publishable key）と シークレットキー（Secret key）を取得。
3. `.env` ファイルに以下のように設定。
```
STRIPE_KEY=your_stripe_public_key
STRIPE_SECRET=your_stripe_secret_key

```




