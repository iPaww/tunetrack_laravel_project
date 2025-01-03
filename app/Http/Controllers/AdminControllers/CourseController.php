<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\courses;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends BasePageController
{
    public string $base_file_path = 'courses.';

    // Display all courses
    public function index()
    {
        $courses = courses::all();
        return $this->view_basic_page($this->base_file_path . 'index', compact('courses'));
    }

    // Show the form to create a new course
    public function create()
    {
        $MainCategory = MainCategory::all();
        return $this->view_basic_page($this->base_file_path . 'create',compact('MainCategory'));
    }

    // Store a newly created course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'objective' => 'required|string',
            'trivia' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $course = new courses();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->objective = $request->objective;
        $course->trivia = $request->trivia;
        $course->category_id = $request->category_id;
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }


    // Show the form to edit an existing course
    public function edit(courses $course)
    {
        $MainCategory = MainCategory::all();
        return $this->view_basic_page($this->base_file_path . 'edit', compact('course', 'MainCategory'));
    }

    // Update the course
    public function update(Request $request, courses $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'objective' => 'required|string',
            'trivia' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $course->name = $request->name;
        $course->description = $request->description;
        $course->objective = $request->objective;
        $course->trivia = $request->trivia;
        $course->category_id = $request->category_id;
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    // Delete a course
    public function destroy(courses $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
