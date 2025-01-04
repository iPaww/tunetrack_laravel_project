<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Products;

class InventorySuppliesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::where('product_type_id', 2)->chunk(50, function (Collection $products) {
            foreach ($products as $product) {
                $randNumber = rand(1, 5);
                $randomMinColor = rand(1, 19);
                $randomMaxColor = rand(19, 38);
                for($x = 1; $x <= $randNumber; $x++) {
                    DB::table('inventory_supplies')->insert([
                        'product_id' => $product->id,
                        'quantity' => rand(1, 15),
                        'color_id' => rand($randomMinColor, $randomMaxColor),
                    ]);
                }
            }
        });
    }
}
