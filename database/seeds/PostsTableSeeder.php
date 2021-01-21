<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Subject;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
      // 全部消す
      DB::table('posts')->delete();

      // faker
      $faker = \Faker\Factory::create('ja_JP');
        
        for($i=0;$i<10;$i++)
        {
          Post::create([ 
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'study_time' => rand(1, 300),
            'text' => $faker->text($maxNbChars = 100),
            'user_id' => User::inRandomOrder()->first()->id
           ]);
        }
    }
}