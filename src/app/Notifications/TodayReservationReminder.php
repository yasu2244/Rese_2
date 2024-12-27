<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TodayReservationReminder extends Notification
{
    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('本日のご予約のリマインド')
            ->line('以下のご予約があります。')
            ->line('店舗名: ' . $this->reservation->shop->name) // 店舗名を表示
            ->line('日時: ' . $this->reservation->reservation_date->format('Y年m月d日 H:i'))
            ->line('お越しをお待ちしております！')
            ->action('予約の詳細を見る', url('/reservations/' . $this->reservation->id));
    }
}
