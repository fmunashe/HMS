<?php

namespace App\Console;

use App\Console\Commands\CalculatePenalts;
use App\Console\Commands\CloseLoans;
use App\Console\Commands\EmailAdvice;
use App\Console\Commands\ExpireGuarantees;
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
        CloseLoans::class,
        EmailAdvice::class,
        CalculatePenalts::class,
        ExpireGuarantees::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('close:loans')->daily()->between('02:00','0300');
        $schedule->command('email:advice')->daily()->between('02:00','0300');
        $schedule->command('calculate:penalts')->daily()->between('02:00','0300');
        $schedule->command('expire:guarantees')->daily()->between('02:00','0300');
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
