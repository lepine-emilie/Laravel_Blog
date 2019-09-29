<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = factory(App\User::class, 100)->create();
         $posts = factory(App\Post::class, 100)->create();
         $comments = factory(\App\Comment::class, 500)->create();
    }

}
