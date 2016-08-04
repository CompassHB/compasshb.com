<?php

class DashboardTest extends TestCase
{
    public function testRead()
    {
        $this->visit('/read');
    }

    public function testReadShow()
    {
        // $this->visit('/read/matthew-1');
    }

    // public function testFellowship()
    // {
    //     $this->visit('/fellowship');
    // }

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
        // $this->visit('series/attributes-of-god');
    }

    public function testSermonDownload()
    {
        // $this->call('GET', '/sermons/dont-forget-his-benefits/download.mp4');
        // $this->assertEquals(302, $this->statusCode());
    }

    public function testVideoDownload()
    {
        // $this->call('GET', '/video/what-is-repentance/download.mp4');
        // $this->assertEquals(302, $this->statusCode());
    }

    public function testBlog()
    {
        $this->visit('/blog');
    }

    public function testBlogLanguage()
    {
        // $this->visit('/blog/what-is-repentance/ja');
    }

    public function testPray()
    {
        $this->visit('/pray');
    }

    public function testCollege()
    {
        $this->visit('/college');
    }

    public function testSongs()
    {
        $this->visit('/songs');
    }
}
