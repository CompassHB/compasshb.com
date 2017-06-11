<?php

class HomepageTest extends TestCase
{
    public function test_it_loads_the_hompeage()
    {
        $this->visit('/');
    }

    public function test_it_loads_the_who_we_are_page()
    {
        $this->visit('/')
             ->click('Who We Are')
             ->SeePageIs('/who-we-are');
    }

    public function test_it_loads_the_kids_page()
    {
        $this->visit('/')
             ->click('Kids Ministry')
             ->SeePageIs('/kids');
    }

    public function test_it_loads_the_youth_page()
    {
        $this->visit('/')
             ->click('Youth Ministry')
             ->SeePageIs('/youth');
    }

    public function test_it_loads_the_sundayschool_page()
    {
        $this->visit('/sundayschool');
    }

    public function test_it_loads_the_eight_distinctives_page()
    {
        $this->visit('/')
             ->click('8 Distinctives')
             ->SeePageIs('/eight-distinctives');
    }

    public function test_it_loads_the_believe_page()
    {
        $this->visit('/')
             ->click('What We Believe')
             ->SeePageIs('/what-we-believe');
    }

    public function test_it_loads_the_ice_cream_evangelism_page()
    {
        $this->visit('/')
             ->click('Ice Cream Evangelism')
             ->SeePageIs('/ice-cream-evangelism');
    }

    public function test_it_loads_the_photos_page()
    {
        $this->visit('/photos');
    }

    public function test_it_loads_the_events_page()
    {
        $this->visit('/events');
    }

    public function test_it_loads_the_sitemap()
    {
        $this->visit('/sitemap.xml');
    }

    public function test_it_loads_the_search_page()
    {
        $this->visit('/search');
    }
}
