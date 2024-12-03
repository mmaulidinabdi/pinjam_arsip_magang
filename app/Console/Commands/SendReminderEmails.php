<?php

namespace App\Console\Commands;

use app;
use App\Console\Kernel;
use Illuminate\Console\Command;

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
        // Panggil metode sendReminderEmails() dari Kernel
        $kernel = app(Kernel::class); // Dapatkan instance dari Kernel
        $kernel->sendReminderEmails();

        $this->info('Reminder emails telah dikirim.');
    }
}
