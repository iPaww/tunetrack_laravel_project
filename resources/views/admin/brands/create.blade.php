<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Product Type</h4>
                </div>
                <div class="card-body">
                    <!-- Product Type Edit Form -->
                    <form action="{{ route('product_type.update', $productType->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Product Type Name Input -->
                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-bold">Product Type Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $productType->name) }}" required>
                        </div>

                        <!-- Buttons (Back and Update) -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">
                                Update
                            </button>
                            <a href="{{ route('product_type.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
