<div class="container mt-5">
    <button class="btn btn-secondary mb-3">
        <a href="{{ route('quiz.index') }}" style="text-decoration: none; color: white;">Back</a>
    </button>
    <h1>Add a New Quiz</h1>
    
    <form action="{{ route('quiz.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="form-group">
            <label for="courseSelect">Select Course</label>
            <select class="form-control" id="courseSelect" name="course_id" required>
                <option value="" disabled selected>Select a course</option>
                @foreach($topic as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
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
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Option A" name="a_answer" required>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Option B" name="b_answer" required>
                </div>
                <div class="col-6 mt-2">
                    <input type="text" class="form-control" placeholder="Option C" name="c_answer" required>
                </div>
                <div class="col-6 mt-2">
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

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
