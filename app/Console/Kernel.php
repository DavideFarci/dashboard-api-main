<?php

namespace App\Console;

use App\Models\Slot;
use App\Models\Time;
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
        $schedule->call(function () {
            $times = Time::all();
            foreach($times as $time){
                $time->visible = 1;
            }
            $time_slot = Slot::all();
            foreach($time_slot as $time){
                $time->visible = 1;
            }
        })->dailyAt('16:39');
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
