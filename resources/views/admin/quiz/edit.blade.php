<div class="container mt-5">
    <h1>Edit Quiz</h1>
    <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="courseSelect">Select Course</label>
            <select class="form-control" id="courseSelect" name="course_id" required>
                <option value="" disabled selected>Select a course</option>
                @foreach($topics as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control" name="question" id="question" value="{{ $quiz->question }}" required>
        </div>

        <div class="form-group">
            <label for="a_answer">Option A</label>
            <input type="text" class="form-control" name="a_answer" id="a_answer" value="{{ $quiz->a_answer }}" required>
        </div>

        <div class="form-group">
            <label for="b_answer">Option B</label>
            <input type="text" class="form-control" name="b_answer" id="b_answer" value="{{ $quiz->b_answer }}" required>
        </div>

        <div class="form-group">
            <label for="c_answer">Option C</label>
            <input type="text" class="form-control" name="c_answer" id="c_answer" value="{{ $quiz->c_answer }}" required>
        </div>

        <div class="form-group">
            <label for="d_answer">Option D</label>
            <input type="text" class="form-control" name="d_answer" id="d_answer" value="{{ $quiz->d_answer }}" required>
        </div>

        <div class="form-group">
            <label for="correct_answer">Correct Answer</label>
            <select name="correct_answer" id="correct_answer" class="form-control" required>
                <option value="a" {{ $quiz->correct_answer == 1 ? 'selected' : '' }}>A</option>
                <option value="b" {{ $quiz->correct_answer == 2 ? 'selected' : '' }}>B</option>
                <option value="c" {{ $quiz->correct_answer == 3 ? 'selected' : '' }}>C</option>
                <option value="d" {{ $quiz->correct_answer == 4 ? 'selected' : '' }}>D</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Quiz</button>
    </form>
</div>
