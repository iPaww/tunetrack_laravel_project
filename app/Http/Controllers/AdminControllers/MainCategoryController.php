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
        MainCategory::create(['name' => $request->input('name')]);
        return redirect('/admin/main-category');
    }

    public function edit($id, Request $request)
    {
        // Use $request->input() to access form data
        MainCategory::where("id", $id)
            ->update(['name' => $request->input('name')]);
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
