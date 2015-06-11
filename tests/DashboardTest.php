<?php

class DashboardTest extends TestCase
{
    public function testRead()
    {
        $this->visit('/read');
    }

    public function testReadShow()
    {
        $this->visit('/read/matthew-1');
    }

    public function testFellowship()
    {
        $this->visit('/fellowship');
    }

    public function testSermons()
    {
        $this->visit('/sermons');
    }

    public function testSeries()
    {
        $this->visit(route('series.index'));
    }

    public function testSeriesShow()
    {
        $this->visit('series/attributes-of-god');
    }

    public function testSermonDownload()
    {
        $this->call('GET', '/sermons/dont-forget-his-benefits/download');
 //       $this->assertEquals(302, $this->statusCode());
    }

    public function testBlog()
    {
        $this->visit('/blog');
    }

    public function testPray()
    {
        $this->visit('/pray');
    }

    public function testSongs()
    {
        $this->visit('/songs');
    }
}
