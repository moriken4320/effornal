<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全部消す
        DB::table('likes')->delete();

        for($i=0;$i<70;$i++){
            $post = Post::inRandomOrder()->first();
            $user_id = User::inRandomOrder()->first()->id;

            $post->likes()->detach($user_id);
            $post->likes()->attach($user_id);
        }
    }
}
