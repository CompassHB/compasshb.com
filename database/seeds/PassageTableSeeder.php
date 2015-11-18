<?php

use CompassHB\Www\Passage;
use Illuminate\Database\Seeder;

class PassageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('passages')->delete();

        factory(Passage::class, 10)->create();
    }
}
