<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'guid' => Str::uuid(),
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'a@a.com',
            'user_role' => 'admin',
            'password' => bcrypt('admin123'),
            'added_by' => 1,
            'is_activated' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
