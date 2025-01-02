<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends BasePageController
{
    public string $base_file_path = 'courses.';
    public function index()
    {
        $Courses = Courses::all();
        return $this->view_basic_page( $this->base_file_path . 'index',compact('Courses'));
    }
}
