<?php

namespace App\Console;

use App\Console\Commands\FetchChannelCommand;
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

        'App\Console\Commands\FetchChannelCommand',

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(FetchChannelCommand::class)
            ->dailyAt('19:46');

        // $schedule->call(function () {

        //     $alreadySavedChannels = Channel::all('id', 'user_id')->toArray();

        //     foreach ($alreadySavedChannels as $alreadySavedChannel) {
        //         $channeldata = YoutubeAdapter::getChannelbyChannelId($alreadySavedChannel['id']);

        //         YoutubeChannelDAO::saveChannel($channeldata, $alreadySavedChannel['user_id']);
        //     }
        // })->dailyAt('16:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    public function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
