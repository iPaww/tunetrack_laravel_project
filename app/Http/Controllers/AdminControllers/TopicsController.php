<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Topics;
use Illuminate\Http\Request;

class TopicsController extends BasePageController
{
    public string $base_file_path = 'topics.';
    public function index()
    {
        $Topics = Topics::all();
        return $this->view_basic_page( $this->base_file_path . 'index',compact('Topics'));
    }
}
