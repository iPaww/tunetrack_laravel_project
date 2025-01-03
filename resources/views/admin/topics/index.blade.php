<div class="topics-content container-fluid p-0">

    <!-- Title and Button Section -->
    <div class="d-flex align-items-center mb-3">
        <h1 class="h4 mb-0 me-auto">Topics</h1>

        <!-- Search Form -->
        <form action="{{ route('topics.index') }}" method="GET" class="d-flex ms-3">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search topics..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary btn-sm ms-2">Search</button>
        </form>

        <a href="{{ route('topics.create') }}" class="btn btn-primary btn-sm ms-3">Add Topic</a>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-bordered table-sm m-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Sub Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Audio</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topics as $topic)
                    <tr>
                        <td>{{ $topic->title }}</td>
                        <td>{{ $topic->sub_category->name }}</td>
                        <td>{{ $topic->description }}</td>
                        <td>
                            <audio controls>
                                <source src="{{ asset('storage/' . $topic->audio) }}" type="audio/mpeg">
                            </audio>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start gap-2">
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
                        <td colspan="5" class="text-center">No topics found for the search criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
                    <!-- Dynamic content here -->
                    @if ($topics->isEmpty() && request('search'))
                        <p>No results found for your search query. Please try again with different keywords.</p>
                    @endif
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
        @if (session('message'))
            var message = '{{ session('message') }}';
            var type = '{{ session('type', 'success') }}';
            var modalBody = document.getElementById('crudModalBody');
            modalBody.innerHTML = message;

            // Show modal
            var crudModal = new bootstrap.Modal(document.getElementById('crudModal'));
            crudModal.show();
        @elseif ($topics->isEmpty() && request('search'))
            var modalBody = document.getElementById('crudModalBody');
            modalBody.innerHTML =
                "No results found for your search query. Please try again with different keywords.";

            // Show modal
            var crudModal = new bootstrap.Modal(document.getElementById('crudModal'));
            crudModal.show();
        @endif
    });
</script>
