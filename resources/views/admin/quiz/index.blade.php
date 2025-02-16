<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-left flex-grow-1 mb-0"><b>Quiz</b></h2>
    <div class="d-flex gap-2">
        <!-- Search Form -->
        <form action="{{ route('quiz.index') }}" method="GET" class="d-flex align-items-center">
            <div class="input-group shadow-sm" style="max-width: 400px;">
                <input
                    type="text"
                    name="query"
                    class="form-control border-secondary"
                    placeholder="Search by course name..."
                    value="{{ request('query') }}"
                    style="height: 44px;"
                >
                <button
                    type="submit"
                    class="btn btn-outline-primary d-flex align-items-center px-4"
                    style="background: linear-gradient(90deg,#6c757d, #495057); border: none; font-size: 16px; color: white;"
                >
                    <i class="fas fa-search me-2"></i> Search
                </button>
            </div>
        </form>

        <!-- Add Quiz Button -->
        <a href="/admin/quiz/add"
            class="btn btn-primary shadow-sm d-flex align-items-center"
            style="background: linear-gradient(90deg,  #007bff, #0056b3); border: none; font-size: 16px; height: 44px; padding: 0 20px;"
        >
            <i class="fas fa-plus me-2"></i> Add Quiz
        </a>
    </div>
</div>

<!-- Table Section with Bootstrap Responsiveness -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Question</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->course->name ?? 'No Course Assigned' }}</td>
                    <td>{{ $quiz->question ?? 'No Question Assigned' }}</td>
                    <td class="text-nowrap">
                        <button 
                            class="btn btn-info btn-sm view-quiz" 
                            data-bs-toggle="modal" 
                            data-bs-target="#viewQuizModal"
                            data-question="{{ $quiz->question }}"
                            data-a="{{ $quiz->a_answer }}"
                            data-b="{{ $quiz->b_answer }}"
                            data-c="{{ $quiz->c_answer }}"
                            data-d="{{ $quiz->d_answer }}"
                            data-correct="{{ $correctAnswerMap[$quiz->correct_answer] ?? 'N/A' }}"
                            data-image="{{ $quiz->quiz_picture ? asset('storage/' . $quiz->quiz_picture) : '' }}"
                            data-audio="{{ $quiz->quiz_audio ? asset('storage/' . $quiz->quiz_audio) : '' }}"
                        >
                            View
                        </button>

                        <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
            
                <tr>
                    <td colspan="10" class="text-center">No quiz found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Pagination -->
<div class="d-flex justify-content-center">
    {{-- {{ $quizzes->links() }} --}}
    {{ $quizzes->appends(request()->except('page'))->links() }}
</div>

</div>

<!-- Quiz Details Modal -->
<div class="modal fade" id="viewQuizModal" tabindex="-1" aria-labelledby="viewQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewQuizModalLabel">Quiz Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Question:</strong> <span id="quizQuestion"></span></p>
                <p><strong>A:</strong> <span id="quizA"></span></p>
                <p><strong>B:</strong> <span id="quizB"></span></p>
                <p><strong>C:</strong> <span id="quizC"></span></p>
                <p><strong>D:</strong> <span id="quizD"></span></p>
                <p><strong>Correct Answer:</strong> <span id="quizCorrect"></span></p>
                <p><strong>Image:</strong></p>
                <img id="quizImage" src="" alt="Quiz Image" class="img-thumbnail" max-width="100px;" style="display: none;">
                <p><strong>Audio:</strong></p>
                <audio id="quizAudio" controls style="display: none;">
                    <source src="" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Modal Data -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.view-quiz').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('quizQuestion').textContent = this.dataset.question;
                document.getElementById('quizA').textContent = this.dataset.a;
                document.getElementById('quizB').textContent = this.dataset.b;
                document.getElementById('quizC').textContent = this.dataset.c;
                document.getElementById('quizD').textContent = this.dataset.d;
                document.getElementById('quizCorrect').textContent = this.dataset.correct;

                // Set Image
                const imageElement = document.getElementById('quizImage');
                if (this.dataset.image) {
                    imageElement.src = this.dataset.image;
                    imageElement.style.display = 'block';
                } else {
                    imageElement.style.display = 'none';
                }

                // Set Audio
                const audioElement = document.getElementById('quizAudio');
                if (this.dataset.audio) {
                    audioElement.querySelector('source').src = this.dataset.audio;
                    audioElement.load(); // Reload the audio element to apply the new source
                    audioElement.style.display = 'block';
                } else {
                    audioElement.style.display = 'none';
                }
            });
        });
    });
</script>