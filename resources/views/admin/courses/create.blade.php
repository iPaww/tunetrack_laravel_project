<form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Course Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Course Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <!-- Category Selection -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Category:</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">Select a category</option>
            @foreach ($MainCategory as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Course Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>

    <!-- Course Objectives -->
    <div class="mb-3">
        <label for="objectives" class="form-label">Objectives:</label>
        <textarea name="objective" id="objective" class="form-control" required></textarea>
    </div>

    <!-- Course Trivia -->
    <div class="mb-3">
        <label for="trivia" class="form-label">Trivia:</label>
        <textarea name="trivia" id="trivia" class="form-control" required></textarea>
    </div>

    <!-- Buttons Section -->
    <div class="d-flex justify-content-center gap-3">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Course</button>

        <!-- Back Button -->
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
