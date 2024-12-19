<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\Controller as BaseController;

class BasePageController extends BaseController
{
    public string $page_title = "TuneTrack | Admin";
    public string $base_file_path = '';
    
    public function view_basic_page( string $page, $params = [], ...$args )
    {
        $template = 'admin.basic_page';
        if( view()->exists('admin.' . $this->base_file_path . 'template') ) 
            $template = 'admin.' . $this->base_file_path . 'template';
        return view( $template, [ 
            'page_title' => $this->page_title,
            'page' => $page,
            ...$params
        ], ...$args );
    }
}