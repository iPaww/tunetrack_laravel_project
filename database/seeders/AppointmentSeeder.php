<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        // You can use factory to create fake data for appointments
        DB::table('appointment')->insert([
            [
                'selected_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'user_id' => 1, // You can change this to a valid user ID
                'sub_category_id' => 1, // You can change this to a valid sub-category ID
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'selected_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'user_id' => 2, // You can change this to a valid user ID
                'sub_category_id' => 2, // You can change this to a valid sub-category ID
                'status' => 'accepted',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'selected_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'user_id' => 3, // You can change this to a valid user ID
                'sub_category_id' => 3, // You can change this to a valid sub-category ID
                'status' => 'declined',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]
        ]);
    }
}
