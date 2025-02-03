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
use App\Models\MainCategory;

class ProductsController extends BasePageController
{
    public string $base_file_path = 'products.';

    private function getCommonData()
    {
        return [
            'categories' => MainCategory::all(),
            'subCategories' => SubCategory::all(),
            'productTypes' => ProductType::all(),
            'brands' => Brands::all(),
        ];
    }

    public function index(Request $request)
    {
        $query = $request->input('query');

        $products = Products::with(['category', 'subCategory', 'productType', 'brand'])
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
            })
            ->paginate(10);

        $commonData = $this->getCommonData();
        return $this->view_basic_page($this->base_file_path . 'index', array_merge(['products' => $products], $commonData));
    }

    public function create()
    {
        $commonData = $this->getCommonData();
        return $this->view_basic_page($this->base_file_path . 'create', $commonData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            // 'category_id' => 'required|exists:category,id',
            // 'sub_category_id' => 'nullable|exists:sub_category,id',
            'product_type_id' => 'nullable|exists:product_type,id',
            'brand_id' => 'nullable|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:10240',
        ]);

        $product = new Products();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->category_id = $request->category_id;
        // $product->sub_category_id = $request->sub_category_id;
        $product->product_type_id = $request->product_type_id;
        $product->brand_id = $request->brand_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs("/products/$product->id", $image->getClientOriginalName(), 'public');
            $product->image = 'storage/' . $imagePath;
            $product->save(); // Save again after setting the image
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $commonData = $this->getCommonData();
        return $this->view_basic_page($this->base_file_path . 'edit', array_merge(['product' => $product], $commonData));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric|min:0|max:100', // Ensure discount is a percentage
        'description' => 'nullable|string',
        // 'category_id' => 'required|exists:category,id',
        // 'sub_category_id' => 'nullable|exists:sub_category,id',
        'product_type_id' => 'nullable|exists:product_type,id',
        'brand_id' => 'nullable|exists:brands,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:10240',
    ]);

    $product = Products::findOrFail($id);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->discount = $request->discount ?? 0;
    $product->description = $request->description;
    // $product->category_id = $request->category_id;
    // $product->sub_category_id = $request->sub_category_id;
    $product->product_type_id = $request->product_type_id;
    $product->brand_id = $request->brand_id;

    if ($request->hasFile('image')) {
        if ($product->image && Storage::exists(str_replace('storage/', '', $product->image))) {
            Storage::delete(str_replace('storage/', '', $product->image));
        }

        $image = $request->file('image');
        $imagePath = $image->storeAs("products/$product->id", $image->getClientOriginalName(), 'public');
        $product->image = 'storage/' . $imagePath;
    }

    $product->save();
    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
}



    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    public function show($id)
{
    $product = Products::with(['productType', 'brand'])->findOrFail($id);
    
    return view('admin.products.show', compact('product'));
}
}
