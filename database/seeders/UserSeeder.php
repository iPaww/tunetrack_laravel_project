<?php

namespace Database\Seeders;

use \DateTime;

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
            'fullname' => fake()->name(),
            'phone_number' => fake()->phoneNumber(11, true),
            'address' => fake()->address(),
            'email' => 'admin@example.com',
            'role' => 1,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
            'image' => '674d8eb22f000_Me.jpg',
            'verified_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'fullname' => fake()->name(),
            'phone_number' => fake()->phoneNumber(11, true),
            'address' => fake()->address(),
            'email' => 'employee@example.com',
            'role' => 2,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
            'image' => '674d8eb22f000_Me.jpg',
            'verified_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'fullname' => fake()->name(),
            'phone_number' => fake()->phoneNumber(11, true),
            'address' => fake()->address(),
            'email' => 'user1@example.com',
            'role' => 3,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
            'image' => '674d8eb22f000_Me.jpg',
            'verified_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'fullname' => fake()->name(),
            'phone_number' => fake()->phoneNumber(11, true),
            'address' => fake()->address(),
            'email' => 'user2@example.com',
            'role' => 3,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
            'image' => '674d8eb22f000_Me.jpg',
            'verified_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'fullname' => fake()->name(),
            'phone_number' => fake()->phoneNumber(11, true),
            'address' => fake()->address(),
            'email' => 'user4@example.com',
            'role' => 3,
            'password' => password_hash('ASDASDqweqwe123!', PASSWORD_DEFAULT),
            'image' => '674d8eb22f000_Me.jpg',
        ]);
    }
}
