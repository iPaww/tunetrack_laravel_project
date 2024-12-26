<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTypeSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insert_type( 'Instrument' );
        $this->insert_type( 'Supply' );
    }

    private function insert_type($cateogry_name)
    {
        return DB::table('product_type')->insert([
            'name' => $cateogry_name,
        ]);
    }
}
