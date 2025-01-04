<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\User;
use App\Http\Controllers\AdminControllers\BasePageController;

class ProfileController extends BasePageController
{
    public string $base_file_path = 'profile.';

    public function index()
    {
        $user = User::where('id', session('admin_user.id'))
            ->first();

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'user' => $user
        ]);
    }
}
