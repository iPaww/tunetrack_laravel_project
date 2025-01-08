<div class="topics-container container mt-5">
    <h1>Create Topic</h1>
    <form action="{{ route('topics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Title Field -->
            <div class="col-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <!-- Course Field -->
            <div class="col-12 mb-3">
                <label for="course_id" class="form-label">Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Description Field -->
            <div class="col-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <!-- Image Upload Field -->
            <div class="col-12 mb-3">
                <label for="image" class="form-label">Add Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            <!-- Audio Upload Field -->
            <div class="col-12 mb-3">
                <label for="audio" class="form-label">Add Audio</label>
                <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
            </div>

            <!-- Back and Submit Button -->
            <div class="col-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('topics.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
