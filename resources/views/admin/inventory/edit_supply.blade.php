<?php
use Illuminate\Support\Collection;
?>
<div class="container">
    <h1>Create Inventory</h1>
    <form action="/admin/inventory/edit/{{ $inventory->product->id }}/product-type/{{ $inventory->product->product_type_id }}/color/{{ $inventory->color_id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Product</label>
            <input class="form-control" value="{{ $inventory->product->name }}" disabled />
        </div>

        <div class="supplies-form-container">
            <div class="mb-3">
                <label for="sub_category_id" class="form-label">Colors</label>
                <select name="color" class="form-select" required>
                    <option selected disabled>Select a color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}" @selected($color->id == old('color', $inventory->color_id))>{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Quantity</label>
                <input text="number" name="quantity" class="form-control" value="{{ old('quantity', $inventory->quantity) }}" min="0" max="99999" required>
            </div>
        </div>

        <div>
            @if ($errors->any())
            <ul class="list-group my-2">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            @if (session()->get('data'))
            <ul class="list-group my-2">
                @foreach (session()->get('data') as $data)
                    <li class="list-group-item list-group-item-success">{{ $data }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Back Button -->
        <div class="d-flex justify-content-between">
            <a href="/admin/inventory" class="btn btn-secondary">Back</a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>