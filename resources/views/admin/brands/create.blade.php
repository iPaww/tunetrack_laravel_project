<!-- resources/views/admin/brands/create.blade.php -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Create New Brand</h4>
                </div>
                <div class="card-body">
                    <!-- Back Button -->
                    <a href="{{ route('brands.index') }}" class="btn btn-secondary mb-4">
                        <i class="bi bi-arrow-left-circle"></i> Back to Brands
                    </a>

                    <!-- Brand Creation Form -->
                    <form action="{{ route('brands.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-bold">Brand Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Create Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
