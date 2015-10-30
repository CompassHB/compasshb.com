<?php

use CompassHB\Www\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

	factory(User::class, 9)->create();

        User::create([
            'name' => 'admin',
            'email' => 'user@example.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
