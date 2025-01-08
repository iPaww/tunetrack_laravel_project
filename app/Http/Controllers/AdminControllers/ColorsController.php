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
        $colors = Colors::all();
        return $this->view_basic_page($this->base_file_path . 'index', compact('colors'));
    }

    // Show the form for creating a new color
    public function create()
    {
        return $this->view_basic_page($this->base_file_path . 'create');
    }

    // Store a newly created color
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Colors::create($request->all());
        return redirect()->route('colors.index')->with('success', 'Color created successfully!');
    }

    // Show the form to edit an existing color
    public function edit($id)
    {
        $color = Colors::findOrFail($id);
        return $this->view_basic_page($this->base_file_path . 'edit', compact('color'));
    }

    // Update an existing color
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $color = Colors::findOrFail($id);
        $color->update($request->all());
        return redirect()->route('colors.index')->with('success', 'Color updated successfully!');
    }

    // Delete a color
    public function destroy($id)
    {
        $color = Colors::findOrFail($id);
        $color->delete();
        return redirect()->route('colors.index')->with('success', 'Color deleted successfully!');
    }
}
