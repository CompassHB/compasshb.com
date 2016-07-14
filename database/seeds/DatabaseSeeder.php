<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->call('TeamTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('SongTableSeeder');
        $this->call('SermonTableSeeder');
        $this->call('SeriesTableSeeder');
        $this->call('BlogTableSeeder');
    }
}
