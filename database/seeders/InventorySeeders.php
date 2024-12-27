<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Products;

class InventorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::chunk(50, function (Collection $products) {
            foreach ($products as $product) {
                $randNumber = rand(2, 5);
                for($x = 1; $x <= $randNumber; $x++) {
                    DB::table('inventory')->insert([
                        'product_id' => $product->id,
                        'quantity' => rand(1, 15),
                        'color_id' => rand(1, 38),
                    ]);
                }
            }
        });
    }
}
