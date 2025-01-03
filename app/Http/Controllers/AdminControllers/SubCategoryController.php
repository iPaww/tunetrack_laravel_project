<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\BasePageController;
use App\Models\MainCategory;
use App\Models\sub_category;
use Illuminate\Http\Request;

class SubCategoryController extends BasePageController
{
    public string $base_file_path = 'sub_category.';

    public function index(Request $request)
    {
        // Check if a search term is provided in the request
    $query = sub_category::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('category_id', 'like', '%' . $request->search . '%');
    }

    // Order by category_id in ascending order
    $sub_category = $query->orderBy('category_id', 'asc')->get();

        return $this->view_basic_page( $this->base_file_path . 'index',compact('sub_category'));
    }

    public function addSub()
    {
        $MainCategory = MainCategory::all();

        return $this->view_basic_page( $this->base_file_path . 'add',compact('MainCategory'));
    }
    public function add( Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate the sub-category name
            'category_id' => 'required|exists:category,id', // Ensure category_id exists in the main_categories table
        ]);

        sub_category::create([
            'name' => $request->name, // Sub-category name
            'category_id' => $request->category_id, // Selected main category ID
        ]);
        return redirect('/admin/sub-category')->with('success', 'Sub-category added successfully');
    }

    public function edit($id,  Request $request)
    {

        sub_category::where("id" ,$id)
        ->update(['name' => $_POST['name_txt']]);
        return redirect( '/admin/sub-category');

    }    public function editSub( $id )
    {
        $MainCategory = MainCategory::all();
        return $this->view_basic_page( $this->base_file_path . 'edit', [
            "id" => $id
        ],compact('MainCategory'));
    }

    public function destroy($id)
{
    try {
        $category = sub_category::findOrFail($id);
        $category->delete();
        return redirect('/admin/sub-category')->with('success', 'Sub-category deleted successfully');
    } catch (\Exception $e) {
        return redirect('/admin/sub-category')->with('error', 'Sub-category not found');
    }
}


}
