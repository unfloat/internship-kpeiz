<?php

namespace App\Console\Commands;

use App\Channel;
use App\Youtube\YoutubeAdapter;
use App\Youtube\YoutubeChannelDAO;
use Illuminate\Console\Command;

class FetchChannelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'channel:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processing channel data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alreadySavedChannels = Channel::all('id', 'user_id')->toArray();

        foreach ($alreadySavedChannels as $alreadySavedChannel) {
            $channeldata = YoutubeAdapter::getChannelbyChannelId($alreadySavedChannel['id']);

            YoutubeChannelDAO::saveChannel($channeldata, $alreadySavedChannel['user_id']);
        }
    }
}
