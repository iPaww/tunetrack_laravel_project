<?php

namespace Database\Seeders;

use \DateTime;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class ReviewsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->orderBy('created_at')->chunk(10, function (Collection $products) {
            foreach ($products as $product) {
                DB::table('orders_item')->orderBy('id')->where('product_id', $product->id)->chunk(10, function (Collection $orders_items) {
                    foreach ($orders_items as $orders_item) {
                        $randNumber = rand(10, 25);
                        DB::table('product_review')->insert([
                            'review' => "It arrived in perfect condition, and I appreciated the included accessories, " .
                            "which made it an even better value. This guitar has quickly become my go-to instrument, and I would highly ".
                            "recommend it to anyone looking for a high-quality, reliable guitar. Whether you're a beginner or a seasoned player, ".
                            "this guitar will exceed your expectations!",
                            'rating' => 5,
                            'user_id' => rand(3, 5),
                            'order_item_id' => $orders_item->id,
                            'created_at' => new Datetime(),
                        ]);
                        for($x = 1; $x <= $randNumber; $x++) {
                            DB::table('product_review')->insert([
                                'review' => fake()->paragraph(10),
                                'rating' => rand(1, 5),
                                'user_id' => rand(3, 5),
                                'order_item_id' => $orders_item->id,
                                'created_at' => fake()->dateTimeAD(),
                            ]);
                        }
                    }
                });
            }
        });
    }
}
