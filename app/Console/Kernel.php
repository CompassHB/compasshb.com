<?php

namespace CompassHB\Www\Console;

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
        'CompassHB\Www\Console\Commands\PassageReminder',
        'CompassHB\Www\Console\Commands\WorksheetReminder',
        'CompassHB\Www\Console\Commands\BoxcastReminder',
        'CompassHB\Www\Console\Commands\BroadcastRefresh',
        'CompassHB\Www\Console\Commands\FeaturedEventReminder'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call('Substrike\Forestall\DatabaseBackup@now')
            ->dailyAt('23:59')
            ->thenPing(config('app.envoyer_heartbeat'));

//        $schedule->command('push:passage')
//            ->dailyAt('06:45');

        $schedule->command('passage:reminder')
            ->dailyAt('20:00');

        $schedule->command('boxcast:reminder')
            ->dailyAt('20:01');

        $schedule->command('featuredevent:reminder')
            ->dailyAt('20:02');

        $schedule->command('worksheet:reminder')
            ->weekly()
            ->Sundays()
            ->at('20:02');

        $schedule->command('broadcast:refresh')
            ->everyThirtyMinutes();
    }
}
