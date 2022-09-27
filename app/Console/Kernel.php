<?php

namespace App\Console;

use App\Models\Cron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:topordered')->everyMinute()->when(function(){
            return Cron::shouldIRun('command:topordered', 1440);
        });
        $schedule->command('command:instructionssent')->everyMinute()->when(function(){
            return Cron::shouldIRun('command:instructionssent', 1440);
        });
        $schedule->command('command:day25')->everyMinute()->when(function(){
            return Cron::shouldIRun('command:day25', 1440);
        });
        $schedule->command('command:day30')->everyMinute()->when(function(){
            return Cron::shouldIRun('command:day30', 1440);
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
