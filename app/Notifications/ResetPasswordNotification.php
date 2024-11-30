<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $verificationUrl;
    public $namaLengkap;
    /**
     * Create a new notification instance.
     */
    public function __construct($verificationUrl, $namaLengkap)
    {
        //
        $this->verificationUrl = $verificationUrl;
        $this->namaLengkap = $namaLengkap;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reset Password')
            ->greeting("Hallo, {$this->namaLengkap}!")
            ->line('Kami menerima permintaan untuk mereset password Anda.')
            ->action('Reset Password', $this->verificationUrl)
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
