<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Create New Brands</h4>
                </div>
                <div class="card-body">
                    <!-- Brands Creation Form -->
                    <form action="{{ route('brands.store') }}" method="POST">
                        @csrf

                        <!-- Brands Name Field -->
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Brands Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Brands name" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons (Back and Create Brands) -->
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success">
                                Create
                            </button>
                            <!-- Back Button -->
                            <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
