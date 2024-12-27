<?php

namespace Database\Seeders;

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
        for( $x = 1; $x <= rand(20, 50); $x++ ) {
            $this->insert_item_order( $this->insert_order(), [ 3 ] );
        }
    }

    private function insert_order()
    {
        return DB::table('orders')->insertGetId([
            'payment_method' => 'Cash',
            'status' => rand(1, 4),
            'total' => rand(200, 50000),
            'user_id' => 3,
        ]);
    }

    private function insert_item_order($order_id, $array_of_product_id)
    {
        foreach( $array_of_product_id as $product_id ) {
            return DB::table('orders_item')->insert([
                'product_id' => $product_id,
                'inventory_id' => 1,
                'price' => rand(200, 50000),
                'quantity' => rand(1, 15),
                'order_id' => $order_id,
            ]);
        }
    }
}
