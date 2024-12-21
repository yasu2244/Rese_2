# Rese
飲食店予約サービス
![Rese_top](https://github.com/yasu2244/Rese/assets/76992290/722ecb94-c975-41af-98e4-8092d91f04ee)

## 作成した目的
webアプリケーション開発の学習のため

## アプリケーションURL
・開発(ローカル)環境<br />
http://localhost<br />
・本番(EC2)環境<br />
https://ec2-54-238-90-144.ap-northeast-1.compute.amazonaws.com/<br />

## 機能一覧
・会員登録/ログイン/ログアウト/マイページ<br />
未ログイン時に画像のメニューロゴから会員登録とログインフォームへ移動できる。<br />
ログイン時にはログアウトとマイページへのリンクが表示される。

![Rese_menu](https://github.com/yasu2244/Rese/assets/76992290/3dfa8092-f6bd-4f6e-a493-f637421e3452)

・検索機能<br />
エリア又はジャンルのプルダウンメニューで選択、または店名を検索するとリアルタイム検索できる。

![Rese_search](https://github.com/yasu2244/Rese/assets/76992290/82f525e9-f940-4e82-918b-d60f0611574e)

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

## 使用技術（実行環境）
・開発フレームワーク<br />
  Laravel: 7.4.9<br />
  livewire": 2.12<br />
・仮想サーバ<br />
  EC2 (開発環境・本番環境)<br />
・データベース<br />
  RDS (本番環境のみ)<br />
・ストレージ<br />
  s3（本番環境のみ）<br />

## テーブル設計
![tabledata1](https://github.com/yasu2244/Rese/assets/76992290/0e00acb9-2961-4bbf-ad4c-8278798168ed)
![tabledata2](https://github.com/yasu2244/Rese/assets/76992290/0ef6369a-4d98-402b-9f1b-4e62e3ff272d)
![tabledata3](https://github.com/yasu2244/Rese/assets/76992290/fd0889be-35a8-4545-adcb-70e0236862e4)

## ER図
![Rese_er](https://github.com/yasu2244/Rese/assets/76992290/490a3934-9905-434f-9b18-5d1b8d1e39c7)

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
次にメール機能を使用するため31行目以降を修正します。今回はgmailを使用しています。
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
* 生成されたパスワードを .env の MAIL_PASSWORD に設定します。
メール送信機能が正常に動くかの確認
```
php artisan tinker
```









