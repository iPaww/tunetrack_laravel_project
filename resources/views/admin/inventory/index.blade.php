<div class="d-flex justify-content-between mb-3">
    <div class="title">
        <h2><b>Inventory</b></h2>
    </div>
    <div class="d-flex">
        <form action="{{ route('admin.inventory.index') }}" method="GET" class="d-flex me-2">
            <div class="input-group me-2">
                <input
                    type="text"
                    name="query"
                    class="form-control border-primary shadow-sm"
                    placeholder="Search products..."
                    value="{{ request('query') }}"
                >
            </div>
            <div class="me-2">
                <select
                    name="product_type"
                    class="form-select shadow-sm"
                    onchange="this.form.submit()"
                >
                    <option value="">All Product Types</option>
                    @foreach ($productTypes as $typeId => $typeName)
                        <option
                            value="{{ $typeId }}"
                            {{ request('product_type') == $typeId ? 'selected' : '' }}
                        >
                            {{ $typeName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button
                type="submit"
                class="btn btn-primary shadow-sm d-flex align-items-center"
                style="background: linear-gradient(to right, #1e90ff, #007bff); border: none;"
            >
                <i class="fas fa-search me-1"></i> Search
            </button>
        </form>
        <a
            class="btn btn-primary shadow-sm d-flex align-items-center"
            href="/admin/inventory/add"
            style="background: linear-gradient(to right, #007bff, #0056b3); border: none;"
        >
            <i class="fas fa-plus me-1"></i> Add
        </a>
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

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Product Type</th>
                <th>Variant</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="text-start">
                        <a href="/admin/inventory/edit/{{ $product->id }}/product-type/{{ $product->product_type_id }}/color/{{ $product->color_id }}"
                            class="text-decoration-none">
                            <img class="img-thumbnail" src="{{ asset($product->image) }}" alt="inventory Image"
                                width="100">
                            <span class="ms-2">{{ $product->name }}</span>
                        </a>
                    </td>
                    <td>{{ $product->type->name }}</td>
                    <td>
                        @if ($product->product_type_id == 1)
                            <ul>
                                @foreach (collect(explode(',', $product->color_names))->unique()->sort()->all() as $color_variant)
                                    <li class="text-start">{{ $color_variant }}</li>
                                @endforeach
                            </ul>
                        @elseif ($product->product_type_id == 2)
                            {{ $product->color_name }}
                        @endif
                    </td>
                    <td>
                        @if ($product->product_type_id == 1)
                            {{ $product->products_quantity }}
                        @elseif ($product->product_type_id == 2)
                            {{ $product->quantity }}
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="/admin/inventory/edit/{{ $product->id }}/product-type/{{ $product->product_type_id }}/color/{{ $product->color_id }}"
                            class="btn btn-primary btn-sm">Edit</a>
                        <form
                            action="/admin/inventory/delete/{{ $product->id }}/product-type/{{ $product->product_type_id }}/color/{{ $product->color_id }}"
                            method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $products->appends(request()->except('page'))->links() }}

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('visible');
            content.classList.toggle('expanded');
        });
    }
</script>
