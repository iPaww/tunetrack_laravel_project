<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Colors;
use Illuminate\Http\Request;

class ColorsController extends BasePageController
{
    public string $base_file_path = 'colors.';
    // Display all colors
    public function index()
    {
        $colors = Colors::all(); // Get all colors from the database
        return $this->view_basic_page($this->base_file_path . 'index', compact('colors'));
    }

    // Show the form for creating a new color
    public function create()
    {
        return $this->view_basic_page($this->base_file_path . 'create'); // return view('admin.colors.create'); // Return the create form view
    }

    // Store a newly created color
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Colors::create($request->all()); // Create new color
        return redirect()->route('colors.index')->with('success', 'Color created successfully!');
    }

    // Show the form to edit an existing color
    public function edit($id)
    {
        $color = Colors::findOrFail($id); // Find color by ID
        // return view('admin.colors.edit', compact('color')); // Return the edit form view with the color
        return $this->view_basic_page($this->base_file_path . 'edit', compact('color'));
    }

    // Update an existing color
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $color = Colors::findOrFail($id); // Find the color by ID
        $color->update($request->all()); // Update the color
        return redirect()->route('colors.index')->with('success', 'Color updated successfully!');
    }

    // Delete a color
    public function destroy($id)
    {
        $color = Colors::findOrFail($id); // Find the color by ID
        $color->delete(); // Delete the color
        return redirect()->route('colors.index')->with('success', 'Color deleted successfully!');
    }
}
