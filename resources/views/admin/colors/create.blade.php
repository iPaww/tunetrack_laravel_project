<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Create New Color</h4>
                </div>
                <div class="card-body">
                    <!-- Color Creation Form -->
                    <form action="{{ route('colors.store') }}" method="POST">
                        @csrf

                        <!-- Color Name Field -->
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Color Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter color name" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            <!-- Back Button -->
                            <a href="{{ route('colors.index') }}" class="btn btn-secondary mb-3">
                                <i class="bi bi-arrow-left-circle"></i> Back to Colors
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success btn-block mt-3">Create Color</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
