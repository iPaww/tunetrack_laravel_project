<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends BasePageController
{
    public string $base_file_path = 'brands.';
    // Display all brands
    public function index()
    {
        $brands = Brands::all(); // Get all brands
        return $this->view_basic_page($this->base_file_path . 'index', compact('brands'));
    }

    // Show the form for creating a new brand
    public function create()
    {
        return view('admin.brands.create'); // Return the create form view
    }

    // Store a newly created brand
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate input
        ]);

        // Create a new brand
        Brands::create($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand created successfully!');
    }

    // Show the form to edit an existing brand
    public function edit($id)
    {
        $brand = Brands::findOrFail($id); // Find the brand by ID
        return view('admin.brands.edit', compact('brand')); // Return the edit form with the brand
    }

    // Update an existing brand
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate input
        ]);

        $brand = Brands::findOrFail($id); // Find the brand by ID
        $brand->update($request->all()); // Update the brand
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');
    }

    // Delete a brand
    public function destroy($id)
    {

        $brand = Brands::findOrFail($id);
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully!');
    }
}
