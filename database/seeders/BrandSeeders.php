<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Yamaha',
        ]);
        DB::table('brands')->insert([
            'name' => 'Fender',
        ]);
        DB::table('brands')->insert([
            'name' => 'Steinway & Sons',
        ]);
        DB::table('brands')->insert([
            'name' => 'Gibson',
        ]);
        DB::table('brands')->insert([
            'name' => 'Roland',
        ]);
        DB::table('brands')->insert([
            'name' => 'Kawai',
        ]);
    }
}
