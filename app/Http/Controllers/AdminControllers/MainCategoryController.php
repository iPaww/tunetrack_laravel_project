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
        $MainCategory = MainCategory::paginate(10);
        return $this->view_basic_page($this->base_file_path . 'index', compact('MainCategory'));
    }

    public function addMain()
    {
        return $this->view_basic_page($this->base_file_path . 'add');
    }

    public function add(Request $request)
    {

    $validated = $request->validate([
        'name' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('main_category_images', 'public');
    }

    // Create the main category
    MainCategory::create([
        'name' => $validated['name'],
        'image' => $imagePath,
    ]);

    return redirect('/admin/main-category')->with('success', 'Category added successfully!');
    }

    public function edit($id, Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $category = MainCategory::findOrFail($id);

    // Handle the image upload
    $imagePath = $category->image;
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
            unlink(storage_path('app/public/' . $category->image));
        }

        // Store the new image
        $imagePath = $request->file('image')->store('maincategory', 'public');
    }

    // Update the category
    $category->update([
        'name' => $validated['name'],
        'image' => $imagePath,
    ]);

    return redirect('/admin/main-category')->with('success', 'Category updated successfully!');
}

    public function editMain($id)
    {
        $category = MainCategory::findOrFail($id);
        return $this->view_basic_page($this->base_file_path . 'edit', compact('category'));
    }

    public function destroy($id){
        $category = MainCategory::findOrFail($id);
        $category->delete();
        return redirect(('/admin/main-category'))->with('success', 'Category deleted successfully!');
    }

}
