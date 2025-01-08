<!-- resources/views/admin/colors/edit.blade.php -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Color</h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('colors.update', $color->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Color Name Field -->
                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-bold">Color Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $color->name) }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button Row (Update and Back) -->
                        <div class="d-flex justify-content-between">
                            <!-- Update Button -->
                            <button type="submit" class="btn btn-success w-48">Update</button>

                            <!-- Back Button -->
                            <a href="{{ route('colors.index') }}" class="btn btn-secondary btn-sm w-48">
                                <i class="bi bi-arrow-left-circle"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
