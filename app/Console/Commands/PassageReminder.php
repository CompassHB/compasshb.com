<?php

namespace CompassHB\Www\Console\Commands;

use Mail;
use Illuminate\Console\Command;
use CompassHB\Www\Passage;

class PassageReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passage:reminder';

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
    public function handle()
    {
        $count = Passage::latest('published_at')->unpublished()->count();

        if ($count < 5) {
            Mail::send('emails.reminder', ['count' => $count], function ($message) {
                $message->subject('Post Scripture of the Day');
                $message->to('info@compasshb.com');
            });
        }
    }
}
