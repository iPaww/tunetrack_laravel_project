<?php

namespace App\Http\Controllers;

use App\Models\Objectives;
use App\Models\Courses;
use App\Models\MainCategory;
use App\Models\Topics;
use App\Http\Controllers\BasePageController;

class ElearningController extends BasePageController
{
    public string $base_file_path = 'elearning.';

    public function view_basic_page( string $page, $params = [], ...$args )
    {
        $categories = MainCategory::orderBy('id')
            ->get();
        
        $courses = [];
        foreach( $categories as $category ) {
            if( !isset( $courses[$category->id] ) )
                $courses[$category->id] = [];
            $courses[$category->id] = Courses::select('id', 'name')
                ->where('category_id', $category->id)
                ->orderBy('created_at', 'desc')
                ->orderBy('name')
                ->get();
        }
        
        $topics = Topics::select('id', 'title')
            ->orderBy('title')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $template = 'basic_page';
        if( view()->exists($this->base_file_path . 'template') ) 
            $template = $this->base_file_path . 'template';
        return view( $template, [ 
            'page_title' => $this->page_title,
            'page' => $page,
            'sidenav' => [
                'categories' => $categories,
                'courses' => $courses,
                'topics' => $topics,
            ],
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
        
        $related_courses = Courses::where('category_id', $category_id )
            ->orderBy('name', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->view_basic_page($this->base_file_path . 'category', compact('category', 'related_courses'));
    }
    
    public function course( $category_id, $course_id )
    {
        $course = Courses::where('id', $category_id )
            ->first();
        
        $related_topics = Topics::select('id', 'title')
            ->where('course_id', $course_id)
            ->get();

        return $this->view_basic_page($this->base_file_path . 'course', compact('course', 'related_topics'));
    }

    public function topic( $category_id, $course_id, $topic_id)
    {
        $course = Courses::where('id', $category_id )
            ->first();
        
        $related_topics = Topics::select('id', 'title')
            ->where('course_id', $course_id)
            ->get();
        
        $topic = Topics::where('id', $topic_id)
            ->first();

        return $this->view_basic_page( $this->base_file_path . 'topic', compact('course', 'topic', 'related_topics'));
    }
}
