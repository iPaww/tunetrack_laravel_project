<div class="course-content container-fluid p-0">
    <!-- Modal for Flash Messages -->
    <div class="modal fade" id="crudNotificationModal" tabindex="-1" aria-labelledby="crudNotificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudNotificationModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="crudMessageContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Title and Button Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Courses</h1>

        <!-- Search Form and Add Course Button -->
        <div class="d-flex gap-2">
            <!-- Search Form -->
            <form action="{{ route('courses.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Search courses..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary btn-sm ms-2">Search</button>
            </form>

            <!-- Add Course Button -->
            <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">Add Course</a>
        </div>
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
                                <a href="{{ route('courses.edit', $course->id) }}"
                                    class="btn btn-warning btn-sm w-auto">Edit</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Check if there's a flash message in the session
        @if (session('message'))
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            // Set the content of the modal based on the message and type
            const modalMessageContent = document.getElementById('crudMessageContent');
            modalMessageContent.textContent = message;

            // Apply class based on the type of message
            const modalBody = document.querySelector('.modal-body');
            modalBody.classList.remove('alert-success', 'alert-info', 'alert-danger');

            if (type === 'success') {
                modalBody.classList.add('alert-success');
            } else if (type === 'info') {
                modalBody.classList.add('alert-info');
            } else if (type === 'danger') {
                modalBody.classList.add('alert-danger');
            }

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('crudNotificationModal'), {
                keyboard: false
            });
            modal.show();
        @endif
    });
</script>
