<h1>Create Product</h1>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <!-- Product Name -->
            <div class="form-group mb-3">
                <label for="name">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                <small class="form-text text-muted">Enter the name of the product.</small>
            </div>
    
            <!-- Product Price -->
            <div class="form-group mb-3">
                <label for="price">Price <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" required>
                <small class="form-text text-muted">Price in your local currency.</small>
            </div>
    
            <!-- Product Description -->
            <div class="form-group mb-3">
                <label for="description">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter product description" required></textarea>
                <small class="form-text text-muted">Provide a brief description of the product.</small>
            </div>
    
            <!-- Product Image -->
            <div class="form-group mb-3">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <small class="form-text text-muted">Optional: Upload an image of the product.</small>
            </div>
    
            <!-- Category -->
            <div class="form-group mb-3">
                <label for="category_id">Category <span class="text-danger">*</span></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" selected>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Sub-Category -->
            <div class="form-group mb-3">
                <label for="sub_category_id">Sub-Category</label>
                <select class="form-control" id="sub_category_id" name="sub_category_id">
                    <option value="" selected>Select a sub-category</option>
                    @foreach($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Choose a sub-category if applicable.</small>
            </div>
    
            <!-- Product Type -->
            <div class="form-group mb-3">
                <label for="product_type_id">Product Type</label>
                <select class="form-control" id="product_type_id" name="product_type_id">
                    <option value="" selected>Select a product type</option>
                    @foreach($productTypes as $productType)
                        <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Specify the type of product (e.g., electronic, furniture).</small>
            </div>
    
            <!-- Brand -->
            <div class="form-group mb-3">
                <label for="brand_id">Brand</label>
                <select class="form-control" id="brand_id" name="brand_id">
                    <option value="" selected>Select a brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Select the brand of the product.</small>
            </div>
    
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-3">Add Product</button>
            </div>
        </form>