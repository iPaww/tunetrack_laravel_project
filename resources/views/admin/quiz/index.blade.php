
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-left flex-grow-1 mb-0"><b>Quiz</b></h2>
        <div class="d-flex">
            <form action="{{ route('quiz.index') }}" method="GET" class="d-flex me-2">
                <input type="text" name="query" class="form-control me-2" placeholder="Search by course name..." value="{{ request('query') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
            <a href="/admin/quiz/add" class="btn btn-primary text-white">Add</a>
        </div>
    </div>

    <!-- Table Section with Bootstrap Responsiveness -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Question</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>Correct Answer</th>
                    <th>Images</th>
                    <th>Audio</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->course->name ?? 'No Course Assigned' }}</td>
                        <td>{{ $quiz->question ?? 'No Question Assigned' }}</td>
                        <td>{{ $quiz->a_answer ?? 'No Answer Provided' }}</td>
                        <td>{{ $quiz->b_answer ?? 'No Answer Provided' }}</td>
                        <td>{{ $quiz->c_answer ?? 'No Answer Provided' }}</td>
                        <td>{{ $quiz->d_answer ?? 'No Answer Provided' }}</td>
                        <td>{{ $correctAnswerMap[$quiz->correct_answer] ?? 'N/A' }}</td>
                        <td>
                            @if ($quiz->quiz_picture)
                                <img src="{{ asset('storage/' . $quiz->quiz_picture) }}" 
                                     alt="Quiz Image" 
                                     width="50" 
                                     height="50" 
                                     class="img-thumbnail">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            @if ($quiz->quiz_audio)
                                <audio controls>
                                    <source src="{{ asset('storage/' . $quiz->quiz_audio) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @else
                                No Audio
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $quizzes->links() }}
    </div>


<!-- Modal Notice -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody">
                <!-- Success message will be dynamically injected -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}";

        if (successMessage) {
            const noticeModalBody = document.getElementById('noticeModalBody');
            const noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));

            // Escape the message to prevent potential XSS
            noticeModalBody.textContent = successMessage.replace(/</g, "&lt;").replace(/>/g, "&gt;");

            // Show the modal
            noticeModal.show();
        }

        // Sidebar toggle logic
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        if (toggleSidebar) {
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('visible');
                content.classList.toggle('expanded');
            });
        }
    });
</script>
