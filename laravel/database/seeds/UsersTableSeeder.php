<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全部消す
      DB::table('users')->delete();

      // faker
      $faker = \Faker\Factory::create('ja_JP');
        
        for($i=0;$i<5;$i++)
        {
          User::create([ 
            'name' => $faker->name(),
            'email' => $faker->email(),
            'password' => bcrypt('111111'),
           ]);
        }
    }
}
