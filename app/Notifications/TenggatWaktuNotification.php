<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TenggatWaktuNotification extends Notification
{
    use Queueable;

    public $histori;
    public $hariTersisa;
    public $namaLengkap;

    /**
     * Buat notifikasi baru.
     */
    public function __construct($histori, $hariTersisa,$namaLengkap)
    {
        $this->histori = $histori;
        $this->hariTersisa = $hariTersisa;
        $this->namaLengkap = $namaLengkap;
    }

    /**
     * Kirimkan notifikasi melalui email.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Peringatan Tenggat Waktu Peminjaman')
            ->greeting("Halo, {$this->namaLengkap}!")
            ->line("Peminjaman dokumen arsip  {$this->histori->nama_arsip} akan habis dalam {$this->hariTersisa} hari.")
            ->line('Segera lakukan pengembalian untuk menghindari denda.')
            ->line('Terima kasih telah menggunakan layanan kami!');
    }
}
