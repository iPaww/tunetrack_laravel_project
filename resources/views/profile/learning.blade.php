<div class="container">
    <h4>My Learning</h4>
    <div class="row">
        @if( count($courses_history) > 0 )
            @foreach ($courses_history as $course_history)
                <div class="col-xl-3 col-md-4 col-sm-6 mb-md-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course_history->course->name }}</h5>
                            <p class="text-truncate">{{ $course_history->course->description }}</p>
                            <div class="h-25">
                                <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="{{ ceil( $course_history->topics_viewed / ($course_history->course->topics->count() || 1)) }}" aria-valuemin="0" aria-valuemax="100">
                                    <div @class([
                                        'progress-bar' => true,
                                        'bg-success' => ceil( ($course_history->topics_viewed / ($course_history->course->topics->count() || 1 )) * 100 ) >= 100,
                                        'bg-warning' => ceil( ($course_history->topics_viewed / ($course_history->course->topics->count() || 1 )) * 100 ) < 100,
                                    ]) style="width: {{ ceil( ($course_history->topics_viewed / ($course_history->course->topics->count() || 1 )) * 100 ) }}%"></div>
                                </div>
                                @if ( ($course_history->topics_viewed >= $course_history->course->topics->count() || 1) )
                                    <div class="text-center">
                                        <small>
                                            You have finished this course
                                        </small>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <small>
                                            In progress, You have finished {{ $course_history->topics_viewed }} out of {{ $course_history->course->topics->count() }} topics
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <a class="btn btn-tunetrack w-100 mt-3" href="/elearning/category/{{ $course_history->course->category_id }}/course/{{ $course_history->course->id }}">
                                @if ( $course_history->topics_viewed >= $course_history->course->topics->count() )
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
                You did not start any quiz yet, please go to our <a href="/elearning" class="text-decoration-none">eLearning</a> section and a new course or continue <a href="/profile/learning" class="text-decoration-none">courses</a>.
            </p>
        </div>
        @endif
        <div class="col-12">
            {{ $courses_history->links() }}
        </div>
    </div>
</div>