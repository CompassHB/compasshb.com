<?php

namespace CompassHB\Www\Console\Commands;

use Parse\ParsePush;
use CompassHB\Www\Passage;
use Parse\ParseInstallation;
use Illuminate\Console\Command;

class PassagePush extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'push:passage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push Scripture of the Day';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $passage = Passage::latest('published_at')->published()->take(1)->get();
        $data = array('alert' => "Today's Scripture of the Day is ".$passage->first()->title);

        // Push to Channels
        ParsePush::send(array(
          'channels' => ['ScriptureOfTheDay'],
          'data' => $data,
        ));

        // Push to Query
        $query = ParseInstallation::query();
        $query->equalTo('design', 'rad');
        ParsePush::send(array(
          'where' => $query,
          'data' => $data,
        ));
    }
}
