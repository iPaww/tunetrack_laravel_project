<div class="container py-5">
    <h1 class="mb-4">Add Course</h1>

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data"
        class="shadow p-4 rounded-lg bg-light">
        @csrf

        <!-- Course Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter course name"
                required>
        </div>

        <!-- Category Selection -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Course Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter course description"
                required></textarea>
        </div>

        <!-- Course Objectives -->
        <div class="mb-3">
            <label for="objective" class="form-label">Objectives</label>
            <textarea name="objective" id="objective" class="form-control" rows="4" placeholder="Enter course objectives"
                required></textarea>
        </div>

        <!-- Course Trivia -->
        <div class="mb-3">
            <label for="trivia" class="form-label">Trivia</label>
            <textarea name="trivia" id="trivia" class="form-control" rows="3" placeholder="Enter course trivia" required></textarea>
        </div>

        <!-- Buttons Section -->
        <div class="d-flex justify-content-end align-items-center mt-4">
            <!-- Back Button -->
            <a href="{{ route('courses.index') }}" class="btn btn-secondary px-3 d-inline-flex align-items-center me-2">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                <i class="fas fa-plus me-2"></i> Create Course
            </button>
        </div>
    </form>
</div>
