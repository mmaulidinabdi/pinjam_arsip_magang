<?php

namespace App\Console;

use Notification;
use App\Models\Histori;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Menjadwalkan pengingat email setiap hari
        $schedule->call(function () {
            $this->sendReminderEmails();
        })->daily();
    }

    public function sendReminderEmails(): void
    {
        // Ambil semua peminjaman yang masih aktif (belum dikembalikan)
        $histories = \App\Models\Histori::whereNull('tanggal_pengembalian')
            ->where('status', 'diacc') // Pastikan status hanya "diacc"
            ->get();

        foreach ($histories as $histori) {
            $tanggalDivalidasi = \Carbon\Carbon::parse($histori->tanggal_divalidasi);
            $tenggatWaktu = $tanggalDivalidasi->addDays(30);
            $hariTersisa = floor(abs(Carbon::now()->diffInDays($tenggatWaktu, false)));
            $namaLengkap = $histori->peminjam->nama_lengkap;

            // Kirim email jika tenggat waktu hampir habis (5 hari atau kurang)
            if ($hariTersisa > 0 && $hariTersisa <= 5) {
                $user = $histori->peminjam; // Pastikan relasi ke user sudah benar
                // Log informasi pengiriman email
                // $this->info("Mengirim email ke: {$user->name} ({$user->email}) dengan histori ID: {$histori->id}");
                // Log::info("Mengirim email ke: {$user->name} ({$user->email}) dengan histori ID: {$histori->id}");
                Notification::send($user, new \App\Notifications\TenggatWaktuNotification($histori, $hariTersisa, $namaLengkap));
            }
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        $this->command('send:reminder-emails')->describe('Kirim pengingat email');

        require base_path('routes/console.php');
    }
}
