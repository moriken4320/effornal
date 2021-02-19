<?php

use Illuminate\Database\Seeder;
use App\User;

class RelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全部消す
        DB::table('relations')->delete();

        for($i=0;$i<15;$i++){
            $user = User::where('email', 'test@user.com')->first();
            $user_id = User::where('id', '!=', $user->id)->inRandomOrder()->first()->id;

            $user->throwers()->detach($user_id);
            $user->throwers()->attach($user_id);
        }
    }
}
