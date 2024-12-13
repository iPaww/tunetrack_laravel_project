<?php

namespace App\Http\Controllers;

use App\Models\Objectives;
use App\Models\InstrumentCategory;
use App\Http\Controller as BaseController;

class ElearningController extends Controller
{
    private $base_file_path = 'elearning.';
    private $string_sub_categories = [ "Cello", "Harp", "Banjo", "Ukulele", "Mandolin", "Viola", "Double Bass", "Lyre", ];
    private $percussion_sub_categories = [ "Snare Drum", "Conga", "Tambourine", "Timpani", "Marimba", "Tabla", "Steel Pan", "Cajon", ];
    private $aerophones_sub_categories = [ "Flute", "Clarinet", "Saxophone", "Oboe", "Harmonica", "Bassoon", "Pan Flute", "Bag Pipes", ];
    private $idiophones_sub_categories = [ "Xylophone", "Triangle", "Glockenspiel", "Kalimba", "Castanets", "Vibraphones", "Cymbals", "Chimes", ];
    private $brass_sub_categories = [ "Trumphet", "Trombone", "Tuba", "Cornet", "Euphonium", "Flugelhorn", "Baritone Horn", "Sousaphone", ];
    private $electrophones_sub_categories = [ "Electric Guitar", "Keyboard", "Electric Bass", "Theremin", "Electric Violin", "Drum Machine", "Electric Organ", "Keytar", ];

    private function view_basic_page( string $page, $params = [ 'category' => 'string', 'sub_categories' => [] ], ...$args )
    {
        return view( $this->base_file_path . 'instrument_page', [ 'page' => $page, 'fullname' => 'Guest', ...$params ], ...$args );
    }

    public function string()
    {
        $objectives = Objectives::first();
        $ins_category = InstrumentCategory::first();

        $string_objective = $objectives['string_obj'];
        $string_content = $ins_category['string'];

        return $this->view_basic_page( $this->base_file_path . 'string', [
            'objective' => $string_objective,
            'content' => $string_content,
            'category' => 'string',
            'sub_categories' => $this->string_sub_categories
        ]);
    }

    public function string_instrument( string $instrument )
    {
        return $this->view_basic_page( $this->base_file_path . 'string_instrument', [
            'category' => 'string',
            'sub_categories' => $this->string_sub_categories
        ]);
    }

    public function percussion()
    {
        $objectives = Objectives::first();
        $ins_category = InstrumentCategory::first();

        $percussion_objective = $objectives['percussion_obj'];
        $percussion_content = $ins_category['percussion'];

        return $this->view_basic_page( $this->base_file_path . 'percussion', [
            'objective' => $percussion_objective,
            'content' => $percussion_content,
            'category' => 'percussion',
            'sub_categories' => $this->percussion_sub_categories
        ]);
    }

    public function percussion_instrument( string $instrument )
    {
        return $this->view_basic_page( $this->base_file_path . 'percussion_instrument', [
            'category' => 'percussion',
            'sub_categories' => $this->percussion_sub_categories
        ]);
    }

    public function aerophones()
    {
        $objectives = Objectives::first();
        $ins_category = InstrumentCategory::first();

        $aerophones_objective = $objectives['aerophones_obj'];
        $aerophones_content = $ins_category['aerophones'];

        return $this->view_basic_page( $this->base_file_path . 'aerophones', [
            'objective' => $aerophones_objective,
            'content' => $aerophones_content,
            'category' => 'aerophones',
            'sub_categories' => $this->aerophones_sub_categories
        ]);
    }

    public function aerophones_instrument( string $instrument )
    {
        return $this->view_basic_page( $this->base_file_path . 'aerophones_instrument', [
            'category' => 'aerophones',
            'sub_categories' => $this->aerophones_sub_categories
        ]);
    }

    public function idiophones()
    {
        $objectives = Objectives::first();
        $ins_category = InstrumentCategory::first();

        $idiophones_objective = $objectives['idiophones_obj'];
        $idiophones_content = $ins_category['idiophones'];

        return $this->view_basic_page( $this->base_file_path . 'idiophones', [
            'objective' => $idiophones_objective,
            'content' => $idiophones_content,
            'category' => 'idiophones',
            'sub_categories' => $this->idiophones_sub_categories
        ]);
    }

    public function idiophones_instrument( string $instrument )
    {
        return $this->view_basic_page( $this->base_file_path . 'idiophones_instrument', [
            'category' => 'idiophones',
            'sub_categories' => $this->idiophones_sub_categories
        ]);
    }

    public function brass()
    {
        $objectives = Objectives::first();
        $ins_category = InstrumentCategory::first();

        $brass_objective = $objectives['brass_obj'];
        $brass_content = $ins_category['brass'];

        return $this->view_basic_page( $this->base_file_path . 'brass', [
            'objective' => $brass_objective,
            'content' => $brass_content,
            'category' => 'brass',
            'sub_categories' => $this->brass_sub_categories
        ]);
    }

    public function brass_instrument( string $instrument )
    {
        return $this->view_basic_page( $this->base_file_path . 'brass_instrument', [
            'category' => 'brass',
            'sub_categories' => $this->brass_sub_categories
        ]);
    }

    public function electrophones()
    {
        $objectives = Objectives::first();
        $ins_category = InstrumentCategory::first();

        $electrophones_objective = $objectives['electrophones_obj'];
        $electrophones_content = $ins_category['electrophones'];

        return $this->view_basic_page( $this->base_file_path . 'electrophones', [
            'objective' => $electrophones_objective,
            'content' => $electrophones_content,
            'category' => 'electrophones',
            'sub_categories' => $this->electrophones_sub_categories
        ]);
    }

    public function electrophones_instrument( string $instrument )
    {
        return $this->view_basic_page( $this->base_file_path . 'electrophones_instrument', [
            'category' => 'electrophones',
            'sub_categories' => $this->electrophones_sub_categories
        ]);
    }
}
