<?php

class StudyControllerTest extends TestCase
{

    /** @test */
    public function visit_the_study_page()
    {
        $this->visit('study');
    }
}