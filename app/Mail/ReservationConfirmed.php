<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * メールで使用する予約情報を受け取る
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * メールの件名と本文を設定
     */
    public function build()
    {
        return $this->subject('【ご予約承りました】' . $this->reservation->shop->name)
                    ->view('emails.reservation_confirmed');
    }
}