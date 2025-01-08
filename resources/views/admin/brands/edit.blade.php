<!-- resources/views/admin/brands/edit.blade.php -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <!-- Card for Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 text-center">Edit Brand</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Brand Name Input -->
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Brand Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $brand->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button Group -->
                        <div class="d-flex justify-content-between">
                            <!-- Update Button -->
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle-fill"></i> Update
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
