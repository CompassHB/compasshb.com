<?php namespace CompassHB\Www\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'CompassHB\Www\Console\Commands\DatabaseBackup',
        'CompassHB\Www\Console\Commands\PassagePush',
        'CompassHB\Www\Console\Commands\BroadcastRefresh',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('db:backup')
                    ->dailyAt('23:59')
                    ->thenPing(env('ENVOYER_HEARTBEAT'));

        $schedule->command('push:passage')
                    ->dailyAt('06:45');

        $schedule->command('broadcast:refresh')
                    ->everyThirtyMinutes();
    }
}
