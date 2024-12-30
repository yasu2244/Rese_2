<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

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
            ->subject('本日のご予約のお知らせ')
            ->view('emails.reminder', [
                'reservation' => $this->reservation,
            ]);
    }
}
