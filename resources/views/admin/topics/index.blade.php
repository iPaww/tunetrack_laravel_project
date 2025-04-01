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
                    <th style="width: 50%;">Title</th>
                    <th style="width: 35%;">Course</th>
                    <th style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topics as $topic)
                    <tr>
                        <td >{{ $topic->title }}</td>
                        <td >
                            {{ $topic->courses ? $topic->courses->name : 'No Course' }}
                        </td>
                        <td>
                            <div class="d-flex justify-content-start gap-3">
                                <button class="btn btn-info btn-sm w-auto view-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewTopicModal"
                                    data-title="{{ $topic->title }}"
                                    data-description="{{ $topic->description }}"
                                    data-image="{{ $topic->image ? asset('storage/' . $topic->image) : '' }}"
                                    data-audio="{{ $topic->audio ? asset('storage/' . $topic->audio) : '' }}"
                                    data-video="{{ $topic->video ? asset('storage/' . $topic->video) : '' }}">
                                View
                            </button>
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
    <!-- View Topic Modal -->
    <div class="modal fade" id="viewTopicModal" tabindex="-1" aria-labelledby="viewTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewTopicModalLabel">Topic Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="topicTitle"></h4>
                    <p id="topicDescription"></p>
                    <div id="topicImage"></div>
                    <div id="topicAudio"></div>
                    <div id="topicVideo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function () {
                const title = this.getAttribute('data-title');
                const description = this.getAttribute('data-description');
                const image = this.getAttribute('data-image');
                const audio = this.getAttribute('data-audio');
                const video = this.getAttribute('data-video');

                document.getElementById('topicTitle').textContent = title;
                document.getElementById('topicDescription').textContent = description;

                // Handle Image
                if (image) {
                    document.getElementById('topicImage').innerHTML = `<img src="${image}" class="img-fluid" style="max-width: 100%;">`;
                } else {
                    document.getElementById('topicImage').innerHTML = '<p class="text-muted">No Image</p>';
                }

                // Handle Audio
                if (audio) {
                    document.getElementById('topicAudio').innerHTML = `
                        <audio controls class="mt-2">
                            <source src="${audio}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>`;
                } else {
                    document.getElementById('topicAudio').innerHTML = '<p class="text-muted">No Audio</p>';
                }

                // Handle Video
                if (video) {
                    document.getElementById('topicVideo').innerHTML = `
                        <video controls class="mt-2" style="max-width: 100%;">
                            <source src="${video}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>`;
                } else {
                    document.getElementById('topicVideo').innerHTML = '<p class="text-muted">No Video</p>';
                }
            });
        });
    });
</script>
