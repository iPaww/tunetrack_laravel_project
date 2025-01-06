<div class="topics-container container mt-5">
    <h1>Create Topic</h1>
    <form action="{{ route('topics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <!-- Course Field -->
        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Sub Category Field    -->
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">Sub Category</label>
            <select name="sub_category_id" id="sub_category_id" class="form-select" required>
                @foreach ($sub_category as $sub_category)
                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Description Field -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <!-- Audio Upload Field -->
        <div class="mb-3">
            <label for="audio" class="form-label">Add Audio</label>
            <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
        </div>

        <!-- Back Button -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('topics.index') }}" class="btn btn-secondary">Back</a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
