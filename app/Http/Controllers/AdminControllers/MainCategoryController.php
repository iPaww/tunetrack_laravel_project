<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\BasePageController;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends BasePageController
{
    public string $base_file_path = 'main_category.';

    public function index()
    {
        $MainCategory = MainCategory::all();
        return $this->view_basic_page($this->base_file_path . 'index', compact('MainCategory'));
    }

    public function addMain()
    {
        return $this->view_basic_page($this->base_file_path . 'add');
    }

    public function add(Request $request)
    {
        // Use $request->input() to access form data
        // Validate the request (ensure the image is an image file and optional)
    $validated = $request->validate([
        'name' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate the image
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('main_category_images', 'public'); // Store the image
    }

    // Create the main category
    MainCategory::create([
        'name' => $validated['name'],
        'image' => $imagePath, // Save the image path
    ]);

    return redirect('/admin/main-category');
    }

    public function edit($id, Request $request)
{
    // Validate the request (ensure the image is an image file and optional)
    $validated = $request->validate([
        'name' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate the image
    ]);

    $category = MainCategory::findOrFail($id);

    // If a new image was uploaded, delete the old one and save the new one
    $imagePath = $category->image;
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
            unlink(storage_path('app/public/' . $category->image));
        }

        // Store the new image
        $imagePath = $request->file('image')->store('main_category_images', 'public');
    }

    // Update the main category
    $category->update([
        'name' => $validated['name'],
        'image' => $imagePath, // Save the new image path
    ]);

    return redirect('/admin/main-category');
}

    public function editMain($id)
    {
        return $this->view_basic_page($this->base_file_path . 'edit', [
            "id" => $id
        ]);
    }

    public function destroy($id){
        $category = MainCategory::findOrFail($id);
        $category->delete();
        return redirect(('/admin/main-category'));
    }

}
