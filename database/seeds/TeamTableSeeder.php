<?php

use CompassHB\Www\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teams')->delete();

        factory(Team::class, 9)->create();

        Team::create([
            'name' => 'Site Administrators',
            'owner_id' => 11,
        ]);

    }
}
