<?php

use CompassHB\Www\Blog;
use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->delete();

        factory(Blog::class, 10)->create([
          'video' => 'https://vimeo.com/134588165'
        ]);
        
    }
}
