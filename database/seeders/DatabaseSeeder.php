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
        \App\Models\User::create([
            'name' => 'Head',
            'email' => 'headteacher@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('head'),
            'role_id' => '3',
            'remember_token' => Str::random(10),
        ]);
    }
}
