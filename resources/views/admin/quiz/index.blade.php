<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-left flex-grow-1 mb-0"><b>Quiz</b></h2>
        <button class="btn btn-primary">
            <a href="/admin/quiz/add" style="text-decoration: none; color: white;">Add</a>
        </button>
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
                        <td>{{ $quiz->correct_answer ?? 'No Answer Provided' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST"
                                style="display:inline-block;">
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
</div>
