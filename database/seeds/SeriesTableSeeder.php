<?php

use CompassHB\Www\Series;
use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('series')->delete();

        factory(Series::class, 10)->create();
    }
}
