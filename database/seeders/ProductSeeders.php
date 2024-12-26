<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Yamaha FX',
            'price' => 500,
            'description' => 'Goods',
            'category_id' => 1,
            'sub_category_id' => 1,
            'product_type_id' => 1,
            'brand_id' => 1,
            'image' => '67557317d4d722.25251400.jpeg',
            'serial_number' =>Str::random(25),
        ]);
        DB::table('products')->insert([
            'name' => 'Trevor James',
            'price' => 500,
            'description' => 'Goods',
            'category_id' => 3,
            'sub_category_id' => 1,
            'product_type_id' => 1,
            'brand_id' => 2,
            'image' => '6755735684e3a3.64016812.webp',
            'serial_number' =>Str::random(25),
        ]);
        DB::table('products')->insert([
            'name' => 'Global',
            'price' => 800,
            'description' => 'Goods',
            'category_id' => 4,
            'sub_category_id' => 4,
            'product_type_id' => 1,
            'brand_id' => 3,
            'image' => '6755737a44a4d4.25204277.jpeg',
            'serial_number' =>Str::random(25),
        ]);
        DB::table('products')->insert([
            'name' => 'Pick',
            'price' => 800,
            'description' => 'Pick for guitars',
            'category_id' => 1,
            'sub_category_id' => 1,
            'product_type_id' => 2,
            'brand_id' => 1,
            'image' => '6755737a44a4d4.25204277.jpeg',
            'serial_number' =>Str::random(25),
        ]);
        // 50 Random Products
        for( $i = 1; $i <= 50; $i++ ) {
            DB::table('products')->insert([
                'name' => 'Instrument Sample ' . $i,
                'price' => rand(100, 50000),
                'description' => 'Pick for guitars',
                'category_id' => rand(1, 6),
                'sub_category_id' => rand(1, 5),
                'product_type_id' => 1,
                'brand_id' => rand(1, 6),
                'image' => '6755737a44a4d4.25204277.jpeg',
                'serial_number' =>Str::random(25),
            ]);
        }

        // 50 Random Supplies
        for( $i = 1; $i <= 50; $i++ ) {
            DB::table('products')->insert([
                'name' => 'Supply Sample ' . $i,
                'price' => rand(100, 50000),
                'description' => 'Pick for guitars',
                'category_id' => rand(1, 6),
                'sub_category_id' => rand(1, 5),
                'product_type_id' => 1,
                'brand_id' => rand(1, 6),
                'image' => '6755737a44a4d4.25204277.jpeg',
                'serial_number' =>Str::random(25),
            ]);
        }
    }
}
