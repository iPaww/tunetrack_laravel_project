<?php

namespace Database\Seeders;

use Illuminate\Support\Collection;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randNumber = rand(20, 50);
        for( $x = 1; $x <= $randNumber; $x++ ) {
            $product_id_array = collect()->times(rand(1, 10), function (int $item) {
                return rand(1, 104);
            })->all();

            $this->insert_item_order($this->insert_order() , $product_id_array);
        }
    }

    private function insert_order()
    {
        return DB::table('orders')->insertGetId([
            'payment_method' => 'Cash',
            'status' => rand(1, 4),
            'total' => rand(200, 50000),
            'user_id' => 3,
            'created_at' => fake()->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        ]);
    }

    private function insert_item_order($order_id, $array_of_product_id)
    {
        foreach( $array_of_product_id as $product_id ) {
            DB::table('orders_item')->insert([
                'product_id' => $product_id,
                'inventory_id' => rand(1, 147),
                'price' => rand(200, 50000),
                'quantity' => rand(1, 15),
                'order_id' => $order_id,
            ]);
        }
    }
}
