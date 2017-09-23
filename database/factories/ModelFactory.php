<?php

use Carbon\Carbon;
use CompassHB\Www\Team;
use CompassHB\Www\User;
use CompassHB\Www\Sermon;
use CompassHB\Www\Series;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'last_login' => Carbon::now(),
    ];
});

$factory->define(Team::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'owner_id' => factory(User::class)->create()->id,
    ];
});

$factory->define(Series::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => factory(User::class)->create()->id,
        'ministryId' => head($faker->shuffle(array(null, 'sundayschool', 'youth'))),
        'image' => 'https://dummyimage.com/600x400/000/fff.jpg',
    ];
});

$factory->define(Sermon::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'excerpt' => $faker->paragraph,
        'user_id' => factory(User::class)->create()->id,
        'teacher' => $faker->name,
        'text' => 'Psalm '.rand(1, 150),
        'worksheet' => 'https://compasshb.s3.amazonaws.com/worksheets/1-And-the-Gospel-Rings-Out.pdf',
        'video' => 'https://vimeo.com/143216705',
        'audio' => 'http://compasshb.s3.amazonaws.com/media/and-the-gospel-rings-out.mp3',
        'published_at' => Carbon::now()->subDays(30),
        'ministryId' => head($faker->shuffle(array(null, 'sundayschool', 'youth'))),
//        'series_id' => factory(Series::class)->create()->id,
    ];
});
