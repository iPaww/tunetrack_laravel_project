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
        $order_Id1 = $this->insert_order();
        $order_Id2 = $this->insert_order();
        
        $this->insert_item_order( $order_Id1, [ 3 ] );
        $this->insert_item_order( $order_Id2, [ 3 ] );
    }

    private function insert_order()
    {
        return DB::table('orders')->insertGetId([
            'payment_method' => 'Cash',
            'status' => 1,
            'total' => 800,
            'user_id' => 3,
        ]);
    }

    private function insert_item_order($order_id, $array_of_product_id)
    {
        foreach( $array_of_product_id as $product_id ) {
            return DB::table('orders_item')->insert([
                'product_id' => $product_id,
                'price' => 800,
                'quantity' => 1,
                'order_id' => $order_id,
            ]);
        }
    }
}
