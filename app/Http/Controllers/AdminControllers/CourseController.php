<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\courses;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class CourseController extends BasePageController
{
    public string $base_file_path = 'courses.';

    // Display all courses
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            // If there's a search query, filter courses based on name or description
            $courses = courses::where('name', 'like', "%{$search}%")
                              ->orWhere('description', 'like', "%{$search}%")
                              ->get();
        } else {
            // If no search query, fetch all courses
            $courses = courses::all();
        }

        // Pass the $courses data to the view
        return $this->view_basic_page($this->base_file_path . 'index', compact('courses'));
    }

    // Show the form to create a new course
    public function create()
    {
        $MainCategory = MainCategory::all();
        return $this->view_basic_page($this->base_file_path . 'create', compact('MainCategory'));
    }

    // Show the form to edit an existing course
    public function edit(courses $course)
    {
        $MainCategory = MainCategory::all(); // Fetch categories for the form
        return $this->view_basic_page($this->base_file_path . 'edit', compact('course', 'MainCategory'));
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

        // Flash message for success
        session()->flash('message', 'Course created successfully!');
        session()->flash('type', 'success');

        return redirect()->route('courses.index');
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

        // Flash message for update
        session()->flash('message', 'Course updated successfully!');
        session()->flash('type', 'info');

        return redirect()->route('courses.index');
    }

    // Delete a course
    public function destroy(courses $course)
    {
        $course->delete();

        // Flash message for deletion
        session()->flash('message', 'Course deleted successfully!');
        session()->flash('type', 'danger');

        return redirect()->route('courses.index');
    }
}
