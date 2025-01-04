<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Products;

class InventoryProductsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::where('product_type_id', 1)->chunk(50, function (Collection $products) {
            foreach ($products as $product) {
                $randNumber = rand(10, 20);
                $randomMinColor = rand(1, 19);
                $randomMaxColor = rand(10, 38);
                for($x = 1; $x <= $randNumber; $x++) {
                    DB::table('inventory_products')->insert([
                        'product_id' => $product->id,
                        'serial_number' => Str::random(20),
                        'color_id' => rand($randomMinColor, $randomMaxColor),
                    ]);
                }
            }
        });
    }
}
