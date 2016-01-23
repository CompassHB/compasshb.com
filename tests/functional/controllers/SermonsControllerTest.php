<?php

use Carbon\Carbon;
use CompassHB\Www\User;
use CompassHB\Www\Sermon;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SermonsControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_sundayschool_video_can_be_posted()
    {
        // And one new post created in the last few days
        $sermon = factory(Sermon::class)->create([
            'published_at' => Carbon::now(),
            'ministryId' => 'sundayschool'
        ]);

        return true;
    }
}
