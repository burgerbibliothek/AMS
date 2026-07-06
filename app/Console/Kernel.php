<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Task Scheduler.
     * Set a cron like this `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1` 
     * in order to schedule the queue worker.
     * @link https://laravel.com/docs/13.x/scheduling
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:work --tries=5 --memory=1024 --timeout=90 --stop-when-empty --backoff=300')
            ->everyMinute()
            ->withoutOverlapping();
    }
}
