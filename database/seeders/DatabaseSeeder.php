<?php

namespace Database\Seeders;

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
        \App\Models\Role::generateRole();
        \App\Models\User::create([
            'name' => 'Head',
            'email' => 'teacher@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('teacher'),
            'role_id' => '2',
            'remember_token' => Str::random(10),
        ]);
    }
}
