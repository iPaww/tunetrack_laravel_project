<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasePageController;

class AppointmentController extends BasePageController
{
    public string $base_file_path = 'appointment.';

    public function index()
    {

        return $this->view_basic_page( $this->base_file_path . 'index');
    }
}
