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
        ]);
    }
}
