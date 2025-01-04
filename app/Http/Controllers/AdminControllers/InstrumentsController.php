<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Categories;
use App\Models\Instruments;
use App\Models\InstrumentTypes;
use App\Models\Supplies;
use App\Http\Controllers\AdminControllers\BasePageController;
use App\Models\Products;

class InstrumentsController extends BasePageController
{
    public string $base_file_path = 'instruments.';

    public function index()
    {
        return $this->view_basic_page( $this->base_file_path . 'index');
    }

    public function add()
    {
        $categories = Categories::get();

        $instruments = Products::join('categories', 'instrument_models.category_id', '=', 'categories.id')
            ->join('instrument_types', 'instrument_models.type_id', '=', 'instrument_types.id')
            ->get();

        return $this->view_basic_page( $this->base_file_path . 'add', [
            'categories' => $categories,
            'instruments' => $instruments,
        ]);
    }

    public function category_add()
    {
        $categories = Categories::get();

        return $this->view_basic_page( $this->base_file_path . 'category_add', [
            'categories' => $categories,
        ]);
    }

    public function type_add()
    {
        $categories = Categories::get();

        $instrument_types = InstrumentTypes::join('categories', 'instrument_types.category_id', '=', 'categories.id')
            ->get();

        return $this->view_basic_page( $this->base_file_path . 'type_add', [
            'categories' => $categories,
            'instrument_types' => $instrument_types,
        ]);
    }

    public function supplies_add()
    {
        $categories = Categories::get();

        $supplies = Supplies::join('categories', 'supplies.category_id', '=', 'categories.id')
            ->get();

        return $this->view_basic_page( $this->base_file_path . 'supplies_add', [
            'categories' => $categories,
            'supplies' => $supplies,
        ]);
    }
}
