<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Brands;
use App\Models\Products;
use App\Models\Categories;
use App\Models\ProductType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminControllers\BasePageController;
use App\Models\Category;

class ProductsController extends BasePageController
{
    public string $base_file_path = 'products.';

    // Fetch common data for create/edit views
    private function getCommonData()
    {
        return [
            'categories' => Categories::all(),
            'subCategories' => SubCategory::all(),
            'productTypes' => ProductType::all(),
            'brands' => Brands::all(),
        ];
    }

    public function index()
    {
        // Eager load relationships to avoid N+1 queries
        $products = Products::with(['category', 'subCategory', 'productType', 'brand'])  // Change 'categories' to 'category'
            ->paginate(10);

        // Fetch common data like categories, subcategories, etc.
        $commonData = $this->getCommonData();

        // Merge common data with products data
        return $this->view_basic_page($this->base_file_path . 'index', array_merge(['products' => $products], $commonData));
    }

    // Show form to create new product
    public function create()

    {
        $commonData = $this->getCommonData();
        return $this->view_basic_page($this->base_file_path . 'create', $commonData);
    }

    // Store newly created product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'product_type_id' => 'nullable|exists:product_types,id',
            'brand_id' => 'nullable|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Products();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_type_id = $request->product_type_id;
        $product->brand_id = $request->brand_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('assets/image/product_image', $image->getClientOriginalName(), 'public');
            $product->image = 'storage/' . $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    // Show form to edit an existing product
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $commonData = $this->getCommonData();
        return $this->view_basic_page($this->base_file_path . 'edit', array_merge(['product' => $product], $commonData));
    }

    // Update the existing product
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Ensure category_id exists
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'product_type_id' => 'nullable|exists:product_types,id',
            'brand_id' => 'nullable|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the product
        $product = Products::findOrFail($id);

        // Update product fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_type_id = $request->product_type_id;
        $product->brand_id = $request->brand_id;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('assets/image/product_image', $image->getClientOriginalName(), 'public');
            $product->image = 'storage/' . $imagePath;
        }

        // Save the updated product
        $product->save();

        // Redirect back with success message
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }


    // Delete the product
    public function destroy($id)
{
    // Find the product by ID
    $product = Products::findOrFail($id);
    
    // Check if the product has an image and delete it from storage
    if ($product->image) {
        // Get the path to the image file
        $imagePath = $product->image;
        
        // Check if the file exists in storage
        if (Storage::exists($imagePath)) {
            // Delete the file
            Storage::delete($imagePath);
        }
    }

    // Delete the product record from the database
    $product->delete();

    // Redirect back with success message
    return redirect()->route('admin.products.index')
        ->with('success', 'Product deleted successfully!');
}
}
