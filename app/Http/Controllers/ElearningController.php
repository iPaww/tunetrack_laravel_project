<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Courses;
use App\Models\MainCategory;
use App\Models\Topics;

use App\Http\Controllers\BasePageController;

class ElearningController extends BasePageController
{
    public string $base_file_path = 'elearning.';

    public function view_basic_page( string $page, $params = [], ...$args )
    {
        $categories = [];
        $courses = [];
        $topics = [];
        
        if( !empty(request()->route('id')) ) {
            $categories = MainCategory::orderBy('name')
                ->get();
            
            $courses =  Courses::select('id', 'name', 'description')
                ->where('category_id', request()->route('id'))
                ->orderBy('name')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
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
            'categories' => $categories,
            'courses' => $courses,
            'topics' => $topics,
            ...$params
        ], ...$args );
    }

    public function index()
    {
        $categories = MainCategory::orderBy('name')
            ->get();
        
        $file = $this->base_file_path . 'index';
        $this->base_file_path = ''; 
        return BasePageController::view_basic_page($file, compact('categories'));
    }
    
    public function category( $category_id )
    {
        $category = MainCategory::where('id', $category_id )
            ->first();
    
        if( empty( $category ) ) {
            return abort(404);
        }

        return $this->view_basic_page($this->base_file_path . 'category', compact('category'));
    }
}