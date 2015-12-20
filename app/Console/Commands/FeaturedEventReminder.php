<?php

namespace CompassHB\Www\Console\Commands;

use Mail;
use Illuminate\Console\Command;
use CompassHB\Www\Contracts\Events;

class FeaturedEventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'featuredevent:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
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
    public function handle(Events $event)
    {
        $featured = $event->search('#compasshb');

        if ($featured->events == null)
        {
            Mail::send('emails.reminderevents', ['count' => $count], function ($message) {
                $message->subject('Post Featured Event');
                $message->to('info@compasshb.com');
            });
        }
    }
}
