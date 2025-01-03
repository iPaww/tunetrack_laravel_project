<div class="container mt-5">
    <div class="course-content">
        <h1 class="mb-4">Edit Course</h1>

        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Course Name -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}"
                    required>
            </div>

            <!-- Description -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $course->description }}</textarea>
            </div>

            <!-- Objective -->
            <div class="form-group mb-3">
                <label for="objective" class="form-label">Objective</label>
                <textarea name="objective" id="objective" class="form-control" required>{{ $course->objective }}</textarea>
            </div>

            <!-- Trivia -->
            <div class="form-group mb-3">
                <label for="trivia" class="form-label">Trivia</label>
                <textarea name="trivia" id="trivia" class="form-control" required>{{ $course->trivia }}</textarea>
            </div>

            <!-- Category -->
            <div class="form-group mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Select a category</option>
                    @foreach ($MainCategory as $category)
                        <option value="{{ $category->id }}"
                            {{ $course->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons Section -->
            <div class="d-flex justify-content-center gap-3">
                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning btn-lg w-auto">Update Course</button>

                <!-- Back Button -->
                <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-lg w-auto">Back</a>
            </div>
        </form>
    </div>
</div>
