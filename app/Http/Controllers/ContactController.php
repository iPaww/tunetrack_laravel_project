<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasePageController;

class ContactController extends BasePageController
{
    public string $base_file_path = 'contact.';

    public function index()
    {
        return $this->view_basic_page( $this->base_file_path . 'index');
    }
}
