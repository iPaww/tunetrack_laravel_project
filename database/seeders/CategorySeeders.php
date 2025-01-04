<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $string_id = $this->insert_main_category('String');
        $percussion_id = $this->insert_main_category('Percussion');
        $aerophones_id = $this->insert_main_category('Aerophones');
        $idiophones_id = $this->insert_main_category('Idiophones');
        $brass_id = $this->insert_main_category('Brass');
        $electrophones_id = $this->insert_main_category('Electrophones');
        
        $this->insert_sub_category( $string_id, [ "Guitar", "Cello", "Harp", "Banjo", "Ukulele", "Mandolin", "Viola", "Double Bass", "Lyre", ] );
        $this->insert_sub_category( $percussion_id, [ "Snare Drum", "Conga", "Tambourine", "Timpani", "Marimba", "Tabla", "Steel Pan", "Cajon", ] );
        $this->insert_sub_category( $aerophones_id, [ "Flute", "Clarinet", "Saxophone", "Oboe", "Harmonica", "Bassoon", "Pan Flute", "Bag Pipes", ] );
        $this->insert_sub_category( $idiophones_id, [ "Xylophone", "Triangle", "Glockenspiel", "Kalimba", "Castanets", "Vibraphones", "Cymbals", "Chimes", ] );
        $this->insert_sub_category( $brass_id, [ "Trumphet", "Trombone", "Tuba", "Cornet", "Euphonium", "Flugelhorn", "Baritone Horn", "Sousaphone", ] );
        $this->insert_sub_category( $electrophones_id, [ "Electric Guitar", "Keyboard", "Electric Bass", "Theremin", "Electric Violin", "Drum Machine", "Electric Organ", "Keytar", ] );
    }

    private function insert_main_category($cateogry_name)
    {
        return DB::table('category')->insertGetId([
            'name' => $cateogry_name,
            
        ]);
    }

    private function insert_sub_category($category_id, $array_of_name)
    {
        foreach( $array_of_name as $sub_category_name ) {
            DB::table('sub_category')->insert([
                'name' => $sub_category_name,
                'category_id' => $category_id
            ]);
        }
    }
}
