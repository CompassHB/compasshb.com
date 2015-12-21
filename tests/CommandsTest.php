<?php

class CommandsTest extends TestCase
{

    public function test_boxcast_reminder()
    {
        $this->call('boxcast:reminder', '');
    }

    public function test_broadcast_refresh()
    {
        $this->call('broadcast:refresh', '');
    }

    public function test_featuredevent_reminder()
    {
        $this->call('featuredevent:reminder', '');
    }

    public function test_worksheet_reminder()
    {
        $this->call('worksheet:reminder', '');
    }

    public function test_passage_reminder()
    {
        $this->call('passage:reminder', '');
    }

    public function test_push_passage()
    {
        $this->call('push:passage', '');
    }

    public function test_forestall()
    {
        $this->call('Substrike\Forestall\DatabaseBackup@now', '');
    }

}
