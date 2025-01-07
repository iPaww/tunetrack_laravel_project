<div class="topics-container container mt-5">
    <h1>Edit Topic</h1>
    <form action="{{ route('topics.update', $topic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $topic->title }}" required>
        </div>
        <!-- Course Field -->
        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $topic->course_id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Description Field -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $topic->description }}</textarea>
        </div>

        <!-- Existing Image Preview -->
        @if ($topic->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $topic->image) }}" alt="Topic Image" style="max-width: 200px;">
            </div>
        @endif

        <!-- Image Upload Field -->
        <div class="mb-3">
            <label for="image" class="form-label">Update Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <!-- Audio Upload Field -->
        <div class="mb-3">
            <label for="audio" class="form-label">Update Audio</label>
            <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
        </div>

        <!-- Back and Submit Button -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('topics.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
