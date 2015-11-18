<?php

use CompassHB\Www\Passage;
use Illuminate\Database\Seeder;

class PassageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('passages')->delete();

        factory(Passage::class, 10)->create();
        factory(Passage::class, 1)->create([
          'published_at' => \Carbon\Carbon::now()->subDays(1)
        ]);
    }
}
