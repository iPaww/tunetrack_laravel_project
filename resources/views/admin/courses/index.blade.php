<div class="course-content container-fluid p-0">
    <!-- Title and Button Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Course Title -->
        <h1 class="h4 mb-0">Courses</h1>
        <!-- Add Course Button -->
        <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">Add Course</a>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-bordered table-sm m-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Objective</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->objective }}</td>
                        <td>{{ $course->category_id }}</td> <!-- Display category -->
                        <td>
                            <div class="d-flex justify-content-start gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('courses.edit', $course->id) }}"
                                    class="btn btn-warning btn-sm w-auto">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-auto">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
