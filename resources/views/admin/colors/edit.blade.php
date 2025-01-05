<!-- resources/views/admin/colors/edit.blade.php -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-light">
                <!-- Back Button -->
                <div class="card-header bg-primary text-white text-center">
                    <a href="{{ route('colors.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                    <h4>Edit Color</h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('colors.update', $color->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Color Name Field -->
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Color Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $color->name) }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success btn-block mt-3">Update Color</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
