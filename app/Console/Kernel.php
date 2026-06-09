<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:work --tries=5 --memory=1024 --timeout=90 --stop-when-empty --backoff=300')
            ->everyMinute()
            ->withoutOverlapping();
    }
}
