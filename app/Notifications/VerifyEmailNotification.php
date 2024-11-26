<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public $verificationUrl;
    public $namaLengkap;

    /**
     * Create a new notification instance.
     */
    public function __construct($verificationUrl, $namaLengkap)
    {
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
    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Verifikasi Email Anda')
            ->greeting("Halo, {$this->namaLengkap}!")
            ->line('Klik tombol di bawah untuk memverifikasi akun email Anda untuk website SIPEKA.')
            ->action('Verifikasi Email', $this->verificationUrl)
            ->line('Jika Anda tidak melakukan registrasi, abaikan email ini.');
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
