<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasePageController;

class AboutUsController extends BasePageController
{
    public string $base_file_path = 'about.';

    public function index()
    {
        return $this->view_basic_page( $this->base_file_path . 'index');
    }
}
