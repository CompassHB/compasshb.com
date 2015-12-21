<?php

use CompassHB\Www\Song;
use CompassHB\Www\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SongsControllerTest extends TestCase
{

    /** @test */
    public function a_new_song_is_created()
    {
        // Given we have a song
        $song = factory(Song::class)->create();


        // then they should see one song when they visit
        // the song page
        $this->visit('songs')
             ->see($song->title);
    }
}