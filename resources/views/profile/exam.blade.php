<style>
    .card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease-in-out;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.btn-primary:hover {
    background-color: #0056b3;
    color: #fff;
}

</style>
<div class="container my-4">
    <h1 class="text-center mb-4"><b>Assessments</b></h1>
    <div class="row">
        @if (count($courses) > 0)
            @foreach ($courses as $course)
                <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary text-center">{{ $course->name }}</h5>
                            <div
                                @class([
                                    'card text-center mt-3 shadow-sm border-0' => true,
                                    'text-bg-warning' => $course->answered < $course->quizes->count(),
                                    'text-bg-success' => $course->answered >= $course->quizes->count() && $course->correct_answers >= $course->quizes->count(),
                                    'text-bg-danger' => $course->answered >= $course->quizes->count() && $course->correct_answers < $course->quizes->count(),
                                ])
                                style="border-radius: 10px;"
                            >
                                <div class="card-body">
                                    @if ($course->answered >= $course->quizes->count())
                                        <h1 class="text-center text-light fs-1 mb-0">
                                            {{ $course->correct_answers }}/{{ $course->quizes->count() }}
                                        </h1>
                                        <p class="text-light">Completed</p>
                                    @else
                                        <p class="text-light fs-5">
                                            In progress: {{ $course->answered }} / {{ $course->quizes->count() }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <a class="btn btn-primary w-100 mt-3"
                                href="/elearning/category/{{ $course->category_id }}/course/{{ $course->id }}/overall">
                                @if ($course->answered >= $course->quizes->count())
                                    See More
                                @else
                                    Continue
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p class="text-center fs-4 text-muted">
                    You have not started any quizzes yet. Please visit our
                    <a href="/elearning" class="text-decoration-none text-primary fw-bold">eLearning</a> section to start a new course or continue your
                    <a href="/profile/learning" class="text-decoration-none text-primary fw-bold">courses</a>.
                </p>
            </div>
        @endif
        <div class="col-12">
            {{ $courses->links() }}
        </div>
    </div>
</div>
