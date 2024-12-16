<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasePageController;

class ProfileController extends BasePageController
{
    public string $base_file_path = 'profile.';

    public function index()
    {
        return $this->view_basic_page( $this->base_file_path . 'index');
    }

    public function learning()
    {
        return $this->view_basic_page( $this->base_file_path . 'learning');
    }

    public function exam()
    {
        return $this->view_basic_page( $this->base_file_path . 'exam');
    }

    public function certificate()
    {
        return $this->view_basic_page( $this->base_file_path . 'certificate');
    }

    public function orders()
    {
        return $this->view_basic_page( $this->base_file_path . 'orders');
    }
}