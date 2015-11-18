<?php

use CompassHB\Www\Sermon;
use Illuminate\Database\Seeder;

class SermonTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sermons')->delete();

        factory(Sermon::class, 10)->create();
    }
}
