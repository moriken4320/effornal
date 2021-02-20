<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Post;
use App\Subject;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'subject_id' => function(){
            return factory(Subject::class);
        },
        'study_time' => 60,
        'text' => $faker->text(500),
        'user_id' => function(){
            return factory(User::class);
        },
    ];
});
