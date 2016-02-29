<?php

use Carbon\Carbon;
use CompassHB\Www\User;
use CompassHB\Www\Passage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_login()
    {
        $this->visit('/login')
             ->type('user@example.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->see('Administration');
    }

    /** @test */
    public function a_user_must_be_signed_in_to_view_their_dashboard()
    {
        $this->visit('admin')
             ->seePageIs('/login');
    }

}
