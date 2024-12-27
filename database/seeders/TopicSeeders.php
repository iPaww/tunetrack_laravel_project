<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TopicSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($x=0; $x <= rand(49, 100); $x++) {
            DB::table('topics')->insert([
                'title' => Str::random(10),
                'description' => Str::random(500),
                'course_id' => rand(1, 6),
                'sub_category_id' => rand(1, 49)
            ]);
        }
    }
}
