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
    <h1 class="text-center mb-4"><b>Courses<b></h1>
    <div class="row">
        @if (count($courses_history) > 0)
            @foreach ($courses_history as $course_history)
                <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary">{{ $course_history->course->name }}</h5>
                            <p class="text-muted text-truncate mb-4" title="{{ $course_history->course->description }}">
                                {{ $course_history->course->description }}
                            </p>
                            <div class="progress mb-3" style="height: 15px; border-radius: 10px; overflow: hidden;">
                                <div
                                    @class([
                                        'progress-bar' => true,
                                        'bg-success' =>
                                            ceil(($course_history->topics_viewed / max($course_history->course->topics->count(), 1)) * 100) >= 100,
                                        'bg-warning' =>
                                            ceil(($course_history->topics_viewed / max($course_history->course->topics->count(), 1)) * 100) < 100,
                                    ])
                                    role="progressbar"
                                    aria-valuenow="{{ ceil(($course_history->topics_viewed / max($course_history->course->topics->count(), 1)) * 100) }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: {{ ceil(($course_history->topics_viewed / max($course_history->course->topics->count(), 1)) * 100) }}%; height: 100%;"
                                ></div>
                            </div>
                            <div class="text-center">
                                @if ($course_history->topics_viewed >= max($course_history->course->topics->count(), 1))
                                    <small class="text-success">You have finished this course</small>
                                @else
                                    <small class="text-warning">
                                        In progress: {{ $course_history->topics_viewed }} out of {{ $course_history->course->topics->count() }} topics
                                    </small>
                                @endif
                            </div>
                            <a class="btn btn-primary w-100 mt-3"
                                href="/elearning/category/{{ $course_history->course->category_id }}/course/{{ $course_history->course->id }}">
                                @if ($course_history->topics_viewed >= $course_history->course->topics->count())
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
                <div class="alert alert-info text-center" style="border-radius: 10px;">
                    <p class="fs-5 mb-0">
                        You haven't started any course yet. Check out our
                        <a href="/elearning" class="text-decoration-none text-primary fw-bold">eLearning</a> section to explore new courses, or continue your
                        <a href="/profile/learning" class="text-decoration-none text-primary fw-bold">current courses</a>.
                    </p>
                </div>
            </div>
        @endif
        <div class="col-12">
            {{ $courses_history->links() }}
        </div>
    </div>
</div>
