<?php

namespace CompassHB\Www\Console\Commands;

use Mail;
use CompassHB\Www\Sermon;
use CompassHB\Www\Passage;
use Illuminate\Console\Command;

class WorksheetReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worksheet:reminder';

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
        $sermon = Sermon::where('ministry', '=', null)->latest('published_at')->published()->get()->first();

        if ($sermon->worksheet == null) {
            Mail::send('emails.worksheet-reminder', [], function ($message) {
                $message->subject('Upload Sermon Worksheet');
                $message->to('brad@compasshb.com');
            });
        }
    }
}
