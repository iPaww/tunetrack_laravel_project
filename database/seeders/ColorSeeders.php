<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColorSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Violins, Violas, Cellos
        $this->insert_color( 'Natural Wood (Light)' );
        $this->insert_color( 'Natural Wood (Medium)' );
        $this->insert_color( 'Natural Wood (Dark)' );

        // Guitars (Acoustic and Electric)
        $this->insert_color( 'Natural Wood (Mahogany)' );
        $this->insert_color( 'Natural Wood (Spruce)' );
        $this->insert_color( 'Natural Wood (Maple)' );
        $this->insert_color( 'Sunburst (Orange)' );
        $this->insert_color( 'Sunburst (Red)' );
        $this->insert_color( 'Sunburst (Black)' );
        $this->insert_color( 'Metallic (Gold)' );
        $this->insert_color( 'Metallic (Solver)' );
        $this->insert_color( 'Black' );
        $this->insert_color( 'White' );
        $this->insert_color( 'Cherry Red' );
        $this->insert_color( 'Blue' );

        // Percussion Drum Sets
        // $this->insert_color( 'Black' );
        // $this->insert_color( 'White' );
        $this->insert_color( 'Red' );
        // $this->insert_color( 'Blue' );
        $this->insert_color( 'Natural Wood Finish' );

        // Marimbas, Xylophones
        $this->insert_color( 'Natural Wood (Rosewood)' );
        $this->insert_color( 'Natural Wood (Synthetic)' );
        // $this->insert_color( 'Black' );

        // Brass Instruments (Trumpets, Trombones, Tubas, etc.)
        $this->insert_color( 'Gold Lacquer' );
        $this->insert_color( 'Silver' );
        $this->insert_color( 'Nickel' );
        $this->insert_color( 'Satin Finish' );
        $this->insert_color( 'Matte Finish' );

        // Woodwind Instruments (Flutes, Clarinets, Saxophones):
        $this->insert_color( 'Black (Plastic)' );
        $this->insert_color( 'Black (Ebony)' );
        $this->insert_color( 'Silver-Plated' );
        $this->insert_color( 'Gold-Plated' );
        $this->insert_color( 'Natural Wood (Oboes)' );
        $this->insert_color( 'Natural Wood (Bbassoons)' );

        // Keyboard Instruments
        $this->insert_color( 'Black (Glossy)' );
        $this->insert_color( 'Black (Matte)' );
        // $this->insert_color( 'White' );
        $this->insert_color( 'Natural Wood (Walnut)' );
        // $this->insert_color( 'Natural Wood (Mahogany)' );
        // $this->insert_color( 'Black' );
        // $this->insert_color( 'White' );
        $this->insert_color( 'Metallic Grey' );

        // Timpani, Snare Drums, Cymbals
        $this->insert_color( 'Copper' );
        $this->insert_color( 'Chrome' );
        $this->insert_color( 'Brass' );
        $this->insert_color( 'Gold' );
    }

    private function insert_color($cateogry_name)
    {
        return DB::table('colors')->insert([
            'name' => $cateogry_name,
        ]);
    }
}
