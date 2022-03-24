<?php

namespace App\Console;

use App\Console\Commands\Sameleon\DumpCommand;
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
        DumpCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
       /* $schedule->command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everyMinute();

        $schedule->command('model:prune', [
            '--model' => [
                \Spatie\Health\Models\HealthCheckResultHistoryItem::class,
            ],
        ])->daily();*/
       // $schedule->command('dumper:run')->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
