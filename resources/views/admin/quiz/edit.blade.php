<div class="container-fluid mt-5">
    <h1>Edit Quiz</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="courseSelect">Select Course</label>
            <select class="form-control" id="courseSelect" name="course_id" required>
                <option value="" disabled>Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control" name="question" id="question" value="{{ $quiz->question }}"
                required>
        </div>

        <div class="form-group">
            <label for="a_answer">Option A</label>
            <input type="text" class="form-control" name="a_answer" id="a_answer" value="{{ $quiz->a_answer }}"
                required>
        </div>

        <div class="form-group">
            <label for="b_answer">Option B</label>
            <input type="text" class="form-control" name="b_answer" id="b_answer" value="{{ $quiz->b_answer }}"
                required>
        </div>

        <div class="form-group">
            <label for="c_answer">Option C</label>
            <input type="text" class="form-control" name="c_answer" id="c_answer" value="{{ $quiz->c_answer }}"
                required>
        </div>

        <div class="form-group">
            <label for="d_answer">Option D</label>
            <input type="text" class="form-control" name="d_answer" id="d_answer" value="{{ $quiz->d_answer }}"
                required>
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
        <div class="form-group">
            <label for="question_order">Question Order</label>
            <input type="number" class="form-control" name="question_order" id="question_order"
                value="{{ $quiz->question_order }}" required>
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-between mt-3">
            <button type="submit" class="btn btn-primary mb-3 mb-sm-0">Update Quiz</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
