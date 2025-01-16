<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Models\Histori;
use App\Notifications\TenggatWaktuNotification;
use Carbon\Carbon;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim pengingat email untuk peminjaman yang belum dikembalikan';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Scheduler berjalan pada: " . now());

        $histories = Histori::whereNull('tanggal_pengembalian')
            ->where('status', 'diacc')
            ->get();

        foreach ($histories as $histori) {
            $tanggalPengambilan = Carbon::parse($histori->tanggal_pengambilan);
            $tenggatWaktu = $tanggalPengambilan->addDays(30);
            $hariTersisa = intVal(Carbon::now()->diffInDays($tenggatWaktu, false));
            $namaLengkap = $histori->peminjam->nama_lengkap;

            if ($hariTersisa > 0 && $hariTersisa <= 5) {
                $user = $histori->peminjam;

                Notification::send($user, new TenggatWaktuNotification($histori, $hariTersisa, $namaLengkap));
                $this->info("Mengirim email ke: {$user->nama_lengkap} ({$user->email}) dengan histori ID: {$histori->id}");
            }
        }

        $this->info('Reminder emails telah dikirim.');
    }
}
