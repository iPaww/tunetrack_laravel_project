<div class="container">
    <h1>Quiz</h1>
    <button class="btn btn-primary"><a href="/admin/quiz/add" style="text-decoration: none; color:white;">Add</a></button>
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
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <!-- Use $quizzes instead of $Quiz -->
                <tr>
                    <td>{{ $quiz->course->name ?? 'No Course Assigned' }}</td>
                    <!-- Assuming 'course' is the relationship to Course model -->
                    <td>{{ $quiz->question ?? 'No Course Assigned' }}</td>
                    <td>{{ $quiz->a_answer ?? 'No Course Assigned' }}</td>
                    <td>{{ $quiz->b_answer ?? 'No Course Assigned' }}</td>
                    <td>{{ $quiz->c_answer ?? 'No Course Assigned' }}</td>
                    <td>{{ $quiz->c_answer ?? 'No Course Assigned' }}</td>
                    <td>{{ $quiz->correct_answer ?? 'No Course Assigned' }}</td>
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
    {{ $quizzes->links() }}
</div>
