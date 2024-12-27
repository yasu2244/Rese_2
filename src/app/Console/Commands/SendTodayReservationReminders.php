<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Notifications\TodayReservationReminder; // リマインド通知
use Carbon\Carbon;

class SendTodayReservationReminders extends Command
{
    protected $signature = 'reminders:today';
    protected $description = 'Send reminders to users about their reservations for today';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();

        // 今日の予約を取得
        $reservations = Reservation::whereDate('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            // ユーザーにリマインド通知を送信
            $reservation->user->notify(new ReservationReminder($reservation));
        }

        $this->info('Reservation reminders have been sent.');
    }
}
