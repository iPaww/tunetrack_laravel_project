<div class="container">
    <h1>Assesments</h1>
    <div class="row">
        @if (count($courses) > 0)
            @foreach ($courses as $course)
                <div class="col-xl-3 col-md-4 col-sm-6 mb-md-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <div @class([
                                'card h-50' => true,
                                'text-bg-warning' => $course->answered < $course->quizes->count(),
                                'text-bg-success' =>
                                    $course->answered >= $course->quizes->count() &&
                                    $course->correct_answers >= $course->quizes->count(),
                                'text-bg-danger' =>
                                    $course->answered >= $course->quizes->count() &&
                                    $course->correct_answers < $course->quizes->count(),
                            ])>
                                <div class="card-body">
                                    @if ($course->answered >= $course->quizes->count())
                                        <h1 class="text-center text-nowrap fs-1">
                                            {{ $course->correct_answers }}/{{ $course->quizes->count() }}</h1>
                                    @else
                                        <p class="text-center">In progress, You have answered {{ $course->answered }} out
                                            of {{ $course->quizes->count() }} questions.</p>
                                    @endif
                                </div>
                            </div>
                            <a class="btn btn-tunetrack w-100 mt-3"
                                href="/elearning/category/{{ $course->category_id }}/course/{{ $course->id }}/overall">
                                @if ($course->answered >= $course->quizes->count())
                                    See more
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
                <p class="text-center fs-4">
                    You did not start any quiz yet, please go to our <a href="/elearning"
                        class="text-decoration-none">eLearning</a> section and a new course or continue <a
                        href="/profile/learning" class="text-decoration-none">courses</a>.
                </p>
            </div>
        @endif
        <div class="col-12">
            {{ $courses->links() }}
        </div>
    </div>
</div>
