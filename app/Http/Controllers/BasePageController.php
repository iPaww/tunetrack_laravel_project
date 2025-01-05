<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Http\Controllers\Controller as BaseController;

class BasePageController extends BaseController
{
    public string $page_title = "TuneTrack";
    public string $base_file_path = '';
    
    public function view_basic_page( string $page, $params = [], ...$args )
    {
        $template = 'basic_page';
        if( view()->exists($this->base_file_path . 'template') ) 
            $template = $this->base_file_path . 'template';
        
        $cart_count = 0;
        if( !empty(session('id')) ) {
            $cart_count = Cart::where('user_id', session('id'))->count();
        }

        return view( $template, [ 
            'page_title' => $this->page_title,
            'page' => $page,
            'cart_count' => $cart_count,
            ...$params
        ], ...$args );
    }
}
