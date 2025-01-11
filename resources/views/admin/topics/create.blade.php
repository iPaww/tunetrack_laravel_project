<div class="container py-5">
    <h1 class="mb-4">Create Topic</h1>
    <form action="{{ route('topics.store') }}" method="POST" enctype="multipart/form-data"
        class="shadow p-4 rounded-lg bg-light">
        @csrf

        <div class="mb-3">
            <!-- Title Field -->
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter topic title"
                required>
        </div>

        <div class="mb-3">
            <!-- Course Field -->
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                <option value="">Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <!-- Description Field -->
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter topic description" required></textarea>
        </div>

        <div class="mb-3">
            <!-- Image Upload Field -->
            <label for="image" class="form-label">Add Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <!-- Audio Upload Field -->
            <label for="audio" class="form-label">Add Audio</label>
            <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                <i class="fas fa-plus me-2"></i> Submit
            </button>

            <!-- Back Button -->
            <a href="{{ route('topics.index') }}" class="btn btn-secondary px-3 d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </form>
</div>
