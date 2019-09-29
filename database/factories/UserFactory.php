<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\User;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'last_name'=> $faker->lastName,
        'first_name'=> $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'dob'=> $faker->date(),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content'=> $faker->text(),
        'tags'=> $faker->words(3, true),
        'user_id'=>$faker->numberBetween(1,100),
    ];
});
$factory->define(Comment::class, function(Faker $faker){
    return[
        'content' => $faker->text,
        'user_id'=>$faker->numberBetween(1,100),
        'post_id'=>$faker->numberBetween(1,100),

    ];
});
