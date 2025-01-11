<div class="container py-5">
    <h1 class="mb-4">Edit Course</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data"
        class="shadow p-4 rounded-lg bg-light">
        @csrf
        @method('PUT')

        <!-- Course Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $course->name) }}" placeholder="Enter course name" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter course description"
                required>{{ old('description', $course->description) }}</textarea>
        </div>

        <!-- Objective -->
        <div class="mb-3">
            <label for="objective" class="form-label">Objective</label>
            <textarea name="objective" id="objective" class="form-control" rows="4" placeholder="Enter course objectives"
                required>{{ old('objective', $course->objective) }}</textarea>
        </div>

        <!-- Trivia -->
        <div class="mb-3">
            <label for="trivia" class="form-label">Trivia</label>
            <textarea name="trivia" id="trivia" class="form-control" rows="3" placeholder="Enter course trivia" required>{{ old('trivia', $course->trivia) }}</textarea>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($course->category_id == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Buttons Section -->
        <div class="d-flex justify-content-end align-items-center mt-4">
            <!-- Back Button -->
            <a href="{{ route('courses.index') }}" class="btn btn-secondary px-3 d-inline-flex align-items-center me-2">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-warning px-3 d-inline-flex align-items-center">
                <i class="fas fa-edit me-2"></i> Update Course
            </button>
        </div>
    </form>
</div>
