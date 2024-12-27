<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BrandSeeders;
use Database\Seeders\CategorySeeders;
use Database\Seeders\ColorSeeders;
use Database\Seeders\CourseSeeders;
use Database\Seeders\InventorySeeders;
use Database\Seeders\OrderSeeders;
use Database\Seeders\ProductSeeders;
use Database\Seeders\ProductTypeSeeders;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BrandSeeders::class,
            CategorySeeders::class,
            ColorSeeders::class,
            ProductTypeSeeders::class,
            UserSeeder::class,
            // NOTE: this should be in the right order because mostly this are foreigned keys
            ProductSeeders::class,
            InventorySeeders::class,
            OrderSeeders::class,
            CourseSeeders::class,
        ]);
    }
}
