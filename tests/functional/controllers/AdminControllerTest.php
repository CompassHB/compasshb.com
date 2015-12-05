<?php

use Carbon\Carbon;
use CompassHB\Www\User;
use CompassHB\Www\Passage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function __construct()
    {
        parent::setUp();
    }

    /** @test **/
    public function a_user_must_be_signed_in_to_view_their_dashboard()
    {
        $this->visit('admin')
           ->seePageIs('/login');
    }

    /** @test **/
    public function a_users_dashboard_shows_all_new_posts_since_they_last_logged_in()
    {
        // Given we have two old posts
        $oldPassage = factory(Passage::class, 2)->create();

        // And one new post created in the last few days
        $newPassage = factory(Passage::class)->create([
          'published_at' => Carbon::now(),
        ]);

        // And a user who hasn't logged in in the last week
        $user = factory(User::class)->create([
          'last_login' => Carbon::now()->subDays(7),
        ]);

        $this->be($user);

        // then they should see one lesson when they visit
        // their dashboard
        $this->visit('admin')
             ->see($newPassage->title)
             ->dontsee($oldPassage[0]->title)
             ->dontsee($oldPassage[1]->title);
    }
}
