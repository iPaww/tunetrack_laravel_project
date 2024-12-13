<?php

namespace App\Http\Controllers;

use App\Models\Instruments;
use App\Models\InstrumentCategory;
use App\Http\Controller as BaseController;

class AppointmentController extends Controller
{
    private $base_file_path = 'appointment.';
    
    private function view_basic_page( string $page, $params = [], ...$args )
    {
        return view( 'basic_page', [ 'page' => $page, 'fullname' => 'Guest', ...$params ], ...$args );
    }

    public function index()
    {

        return $this->view_basic_page( $this->base_file_path . 'index');
    }
}
