<div class="topics-content container-fluid p-0">

    <!-- Title and Button Section -->
    <div class="d-flex align-items-center mb-3">
        <h1 class="h2 mb-0 me-auto"><b>Topics</b></h1>

        <!-- Search Form -->
        <form action="{{ route('topics.index') }}" method="GET" class="d-flex align-items-center ms-3">
            <div class="input-group shadow-sm" style="max-width: 400px;">
                <input
                    type="text"
                    name="search"
                    class="form-control border-secondary"
                    placeholder="Search topics..."
                    value="{{ request('search') }}"
                    aria-label="Search topics"
                    style="height: 44px;"
                >
                <button
                    type="submit"
                    class="btn btn-secondary d-flex align-items-center px-4"
                    style="background: linear-gradient(90deg, #6c757d, #495057); border: none; font-size: 16px;"
                >
                    <i class="fas fa-search me-2"></i> Search
                </button>
            </div>
        </form>

        <a href="{{ route('topics.create') }}"
            class="btn btn-primary ms-3 shadow-sm d-flex align-items-center"
            style="background: linear-gradient(90deg, #007bff, #0056b3); border: none; font-size: 16px; height: 44px; padding: 0 20px;"
        >
            <i class="fas fa-plus me-2"></i> Add Topic
        </a>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-bordered table-sm m-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Course</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Audio</th>
                    <th scope="col">Video</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topics as $topic)
                    <tr>
                        <td class="text-truncate" style="max-width: 10em;">{{ $topic->title }}</td>
                        <td class="text-truncate" style="max-width: 8em;">
                            {{ $topic->courses ? $topic->courses->name : 'No Course' }}
                        </td>
                        <td class="text-truncate" style="max-width: 12em;">{{ $topic->description }}</td>
                        <td>
                            @if ($topic->image)
                                <img src="{{ asset('storage/' . $topic->image) }}" alt="Topic Image"
                                    style="width: 50px; height: auto;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            @if ($topic->audio)
                                <audio controls>
                                    <source src="{{ asset('storage/' . $topic->audio) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @else
                                <span class="text-muted">No Audio</span>
                            @endif
                        </td>
                        <td>
                            @if ($topic->video)
                                <video width="100" controls>
                                    <source src="{{ asset('storage/' . $topic->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <span class="text-muted">No Video</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-start gap-3">
                                <a href="{{ route('topics.edit', $topic->id) }}"
                                    class="btn btn-warning btn-sm w-auto">Edit</a>

                                <form action="{{ route('topics.destroy', $topic->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this topic?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-auto">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No topics found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $topics->appends(['search' => request('search')])->links() }}
    </div>

    <!-- Modal Notification for CRUD Actions -->
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="crudModalBody">
                    <!-- Dynamic content will be added here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Check if session has 'message'
        @if (session('message'))
            const message = '{{ session('message') }}';
            const type = '{{ session('type', 'info') }}'; // Default type is 'info'

            // Set the modal body content dynamically
            const modalBody = document.getElementById('crudModalBody');
            modalBody.innerHTML = `<p class="text-dark${type}">${message}</p>`;

            // Display the modal
            const crudModal = new bootstrap.Modal(document.getElementById('crudModal'));
            crudModal.show();
        @endif
    });
</script>
<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('visible');
            content.classList.toggle('expanded');
        });
    }
</script>
