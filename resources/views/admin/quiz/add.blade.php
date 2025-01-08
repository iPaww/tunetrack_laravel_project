<div class="container mt-5">
    <h1>Add a New Quiz</h1>

    <form action="{{ route('quiz.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="form-group">
            <label for="courseSelect">Select Course</label>
            <select class="form-control" id="courseSelect" name="course_id" required>
                <option value="" disabled selected>Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question">Question</label>
            <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Options</label>
            <div class="row">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control" placeholder="Option A" name="a_answer" required>
                </div>
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control" placeholder="Option B" name="b_answer" required>
                </div>
                <div class="col-12 col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Option C" name="c_answer" required>
                </div>
                <div class="col-12 col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Option D" name="d_answer" required>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="correct_answer">Correct Answer</label>
            <select class="form-control" id="correct_answer" name="correct_answer" required>
                <option value="a">Option A</option>
                <option value="b">Option B</option>
                <option value="c">Option C</option>
                <option value="d">Option D</option>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="question_order">Quiz Order</label>
            <input type="text" class="form-control" id="question_order" name="question_order"
                placeholder="Enter quiz order" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
