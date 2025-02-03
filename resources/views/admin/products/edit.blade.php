<div class="container mt-5">
    <h2 class="title mb-4 text-center">Edit Product</h2>

    <div class="container mt-5">
        <h2 class="title mb-4">Edit Product</h2>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Price -->
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Product Type -->
            <div class="form-group">
                <label for="product_type_id">Product Type</label>
                <select class="form-control @error('product_type_id') is-invalid @enderror" id="product_type_id"
                    name="product_type_id">
                    <option value="">Select Product Type</option>
                    @foreach ($productTypes as $productType)
                        <option value="{{ $productType->id }}"
                            {{ old('product_type_id', $product->product_type_id) == $productType->id ? 'selected' : '' }}>
                            {{ $productType->name }}</option>
                    @endforeach
                </select>
                @error('product_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Brand -->
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Image -->
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <!-- Display current image if available -->
                @if ($product->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" width="100">
                    </div>
                @endif
            </div>
            <!--For discount-->
            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount"
                    name="discount" min="0" max="100" value="{{ old('discount', $product->discount) }}" required>
                @error('discount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</div>

<!-- Add some custom CSS for styling -->
<style>
    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 0.375rem;
        padding: 0.75rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: #e74a3b;
    }

    .btn-block {
        width: 100%;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .row .col-md-6 {
        padding: 0 15px;
    }

    .mt-2 img {
        border: 2px solid #ddd;
        border-radius: 4px;
    }

    .text-center {
        font-weight: bold;
    }
</style>
