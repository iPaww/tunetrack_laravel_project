<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\BasePageController;

class QuizController extends BasePageController
{
    public string $base_file_path = 'quiz.';

    public function index()
    {
        return $this->view_basic_page( $this->base_file_path . 'index');
    }
}
