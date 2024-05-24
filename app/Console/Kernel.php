<?php

namespace App\Console;

use App\Http\Controllers\AbsensiController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // Fungsi schedule digunakan untuk mendefinisikan semua tugas yang dijadwalkan dalam aplikasi Laravel
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $controller = new AbsensiController();
            $controller->checkAndUpdateStatus();
            Log::info('Scheduler has run at ' . now());
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
