<h1 class="fs-1">{{ $course->name }}</h1>
<p class="fs-4 text-break">{{ $course->description }}</p>
<h3 class="fs-3">Topics</h3>
<div class="card topic-card">
    <div class="card-body row">
        <div class="col-4 border-end">
            @foreach ($topics as $rel_topic)
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $rel_topic->id }}" class="text-decoration-none text-white">
                <div class="topic-list">{{ $rel_topic->title }}</div>
            </a>
            @endforeach
            <a class="text-reset text-decoration-none" data-bs-toggle="collapse" 
                href="quiz" role="button" aria-expanded="false" aria-controls="quiz">
                <div class="topic-list active">Quiz</div>
            </a>
            @if ( !empty( session('id') ) )
            <div class="topics-div collapse show" id="quiz">
                @foreach ( $quizes as $quiz_nav )
                    <a class="text-reset text-decoration-none"
                        href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz/{{ $quiz_nav->id }}"
                    >
                        <div class="sub-topic-list text-capitalize">Quiz #{{ $quiz_nav->question_order }}</div>
                    </a>
                @endforeach
            </div>
            @endif
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/overall" class="text-decoration-none text-white">
                <div class="topic-list">Overall</div>
            </a>
        </div>
        <div class="col-8">
            <h3 class="fs-3 fw-bold text-center">Quiz</h3>
            @if ( count( $quizes ) > 0 )
                @if( $started )
                <h4 class="text-bg-success rounded-top py-1 px-3">Attention</h4>
                <p>
                    You have already started your exam, please finish it to see the result.
                </p>
                <h4>Reminder:</h4>
                <p class="text-break">
                    Cheating, including but not limited to the use of unauthorized tools, software, or external assistance, is strictly prohibited on this platform to maintain fairness and the integrity of the experience.
                    We encourage honest participation to ensure accurate tracking of your progress and to foster a genuine sense of achievement. There are no time limits imposed, giving you the flexibility to engage at your own pace and focus on quality rather than speed.
                    Your progress is being carefully monitored and recorded, both to help you track your milestones and to maintain a secure and equitable environment for all users.
                    If you are ready to proceed and agree to abide by these rules, please log in to your account to continue your journey. Your commitment to fair practices will enrich not only your experience but also help us understand in which we can improve.
                </p>
                <div class="text-center">
                    <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz/{{ $quizes[0]->id }}" class="btn btn-lg btn-success">Continue</a>
                </div>
                @else
                <h4 class="text-bg-warning rounded-top py-1 px-3">Attention</h4>
                <p class="text-break">
                    Cheating, including but not limited to the use of unauthorized tools, software, or external assistance, is strictly prohibited on this platform to maintain fairness and the integrity of the experience.
                    We encourage honest participation to ensure accurate tracking of your progress and to foster a genuine sense of achievement. There are no time limits imposed, giving you the flexibility to engage at your own pace and focus on quality rather than speed.
                    Your progress is being carefully monitored and recorded, both to help you track your milestones and to maintain a secure and equitable environment for all users.
                    If you are ready to proceed and agree to abide by these rules, please log in to your account to continue your journey. Your commitment to fair practices will enrich not only your experience but also help us understand in which we can improve.
                </p>
                <div class="text-center">
                    <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz/{{ $quizes[0]->id }}" class="btn btn-lg btn-warning">Proceed</a>
                </div>
                @endif
            @else
                <p class="text-break fs-3 text-center">
                    Sorry, there are no quizes available for this course.
                </p>
            @endif
        </div>
    </div>
    
</div>