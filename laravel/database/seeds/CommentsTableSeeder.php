<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全部消す
        DB::table('comments')->delete();

        // faker
        $faker = \Faker\Factory::create('ja_JP');

        
        for($i=0;$i<70;$i++){

            $post_id = Post::inRandomOrder()->first()->id;
            $user_id = User::inRandomOrder()->first()->id;

            Comment::create([
                'post_id' => $post_id,
                'user_id' => $user_id,
                'comment' => "【以下はFakerの文字列です】\n" . $faker->realText(20),
                ]);
        }
    }
}
