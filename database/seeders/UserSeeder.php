<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => Str::random(10),
            'phone_number' => Str::random(11),
            'address' => Str::random(25),
            'email' => 'admin@example.com',
            'role' => 1,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
        ]);
        DB::table('users')->insert([
            'fullname' => Str::random(10),
            'phone_number' => Str::random(11),
            'address' => Str::random(25),
            'email' => 'employee@example.com',
            'role' => 2,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
        ]);
        DB::table('users')->insert([
            'fullname' => Str::random(10),
            'phone_number' => Str::random(11),
            'address' => Str::random(25),
            'email' => 'user1@example.com',
            'role' => 3,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
        ]);
        DB::table('users')->insert([
            'fullname' => Str::random(10),
            'phone_number' => Str::random(11),
            'address' => Str::random(25),
            'email' => 'user2@example.com',
            'role' => 3,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
        ]);
        DB::table('users')->insert([
            'fullname' => Str::random(10),
            'phone_number' => Str::random(11),
            'address' => Str::random(25),
            'email' => 'user4@example.com',
            'role' => 3,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
        ]);
    }
}
