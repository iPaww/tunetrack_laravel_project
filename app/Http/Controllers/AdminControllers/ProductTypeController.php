<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends BasePageController
{
    public string $base_file_path = 'product_type.';
    // Display all product types
    public function index()
    {
        $productTypes = ProductType::all();

        return $this->view_basic_page($this->base_file_path . 'index', compact('productTypes'));
    }

    // Show the form for creating a new product type
    public function create()
    {
        return view('admin.product_type.create');
    }

    // Store a newly created product type in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate the name field
        ]);

        ProductType::create($request->all());

        return redirect()->route('product_type.index')->with('success', 'Product Type created successfully!');
    }

    // Show the form for editing a product type
    public function edit($id)
    {
        $productType = ProductType::findOrFail($id);

        return view('admin.product_type.edit', compact('productType'));
    }

    // Update an existing product type in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255', // Validate the name field
        ]);

        $productType = ProductType::findOrFail($id);

        $productType->update($request->all());

        return redirect()->route('admin.product_type.index')->with('success', 'Product Type updated successfully!');
    }

    // Delete a product type from the database
    public function destroy($id)
    {
        $productType = ProductType::findOrFail($id);

        $productType->delete();

        return redirect()->route('product_type.index')->with('success', 'Product Type deleted successfully!');
    }

}
