<div class="container py-5">
    <h1 class="mb-4">Edit Topic</h1>
    <form action="{{ route('topics.update', $topic->id) }}" method="POST" enctype="multipart/form-data"
        class="shadow p-4 rounded-lg bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <!-- Title Field -->
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $topic->title }}"
                placeholder="Enter topic title" required>
        </div>

        <div class="mb-3">
            <!-- Course Field -->
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $topic->course_id ? 'selected' : '' }}>
                        {{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <!-- Description Field -->
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter topic description" required>{{ $topic->description }}</textarea>
        </div>

        @if ($topic->image)
            <!-- Existing Image Preview -->
            <div class="mb-3">
                <label for="existing_image" class="form-label">Existing Image</label>
                <img src="{{ asset('storage/' . $topic->image) }}" alt="Topic Image" class="img-fluid"
                    style="max-width: 200px;">
            </div>
        @endif

        <div class="mb-3">
            <!-- Image Upload Field -->
            <label for="image" class="form-label">Update Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <!-- Audio Upload Field -->
            <label for="audio" class="form-label">Update Audio</label>
            <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
        </div>

        <!-- Buttons Section -->
        <div class="d-flex justify-content-between mt-4">
            <!-- Submit Button with Icon -->
            <button type="submit" class="btn btn-warning btn-lg w-auto">
                <i class="fas fa-save me-2"></i> Update Topic
            </button>

            <!-- Back Button with Icon -->
            <a href="{{ route('topics.index') }}" class="btn btn-secondary btn-lg w-auto">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </form>
</div>
