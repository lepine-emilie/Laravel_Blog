<?php

use App\role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin'
        ]);
        Role::create([
            'name' => 'Blogueur'
        ]);
        Role::create([
            'name' => 'Commentateur'
        ]);
    }
}
