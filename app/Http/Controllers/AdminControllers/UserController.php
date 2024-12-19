<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\User;
use App\Http\Controllers\AdminControllers\BasePageController;

class UserController extends BasePageController
{
    public string $base_file_path = 'users.';

    public function index()
    {
        $users = User::get();

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'users' => $users,
        ]);
    }
}
