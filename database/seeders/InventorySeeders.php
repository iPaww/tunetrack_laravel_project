<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InventorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory')->insert([
            'product_id' => 1,
            'quantity' => 15,
            'color_id' => 4,
        ]);
        DB::table('inventory')->insert([
            'product_id' => 1,
            'quantity' => 15,
            'color_id' => 12,
        ]);
        DB::table('inventory')->insert([
            'product_id' => 2,
            'quantity' => 15,
            'color_id' => 4,
        ]);
        DB::table('inventory')->insert([
            'product_id' => 3,
            'quantity' => 15,
            'color_id' => 4,
        ]);
        DB::table('inventory')->insert([
            'product_id' => 3,
            'quantity' => 15,
            'color_id' => 5,
        ]);
    }
}
