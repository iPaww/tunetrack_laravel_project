<h1 class="fs-1">{{ $course->name }}</h1>
<p class="fs-4 text-break">{{ $course->description }}</p>
<h3 class="fs-3">Topics</h3>
<div class="card topic-card">
    <div class="card-body row">
        <div class="col-4 border-end">
            @foreach ($topics as $rel_topic)
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $rel_topic->id }}" class="text-decoration-none text-white">
                <div class="topic-list @if (request()->route('topic_id') == $rel_topic->id) active @endif">{{ $rel_topic->title }}</div>
            </a>
            @endforeach
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz" class="text-decoration-none text-white">
                <div class="topic-list">Quiz</div>
            </a>
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/overall" class="text-decoration-none text-white">
                <div class="topic-list active">Overall</div>
            </a>
        </div>
        <div class="col-8">
            <h3 class="fs-3 fw-bold text-center">Overall</h3>
            @if ( $finished )
            <div
                @class([
                    'card' => true,
                    'text-bg-success' => $passed,
                    'text-bg-danger' => !$passed,
                ])
            >
                <div class="card-body">
                    <h1 class="text-center" style="font-size: 10em;">{{ $score }}/{{ $questions }}</h1>
                </div>
            </div>
            <p class="fs-3 text-center">
                @if ( $passed )
                    {{-- Congratulations you passed the exam!!! <br>You can find you cerficate on your <a href="/profile/certificate" class="text-decoration-none">profile</a>. --}}
                    Congratulations you passed the exam!!! <br><small class="fs-6">if you find it intresting please select another course</small>.
                @else
                    You Failed, you can try again. Make sure to review all the topics covered.
                    <div>
                        <form action="" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                            <div class="text-center">
                                <button class="btn btn-lg btn-elearning">Retake Exam</button>
                            </div>
                        </form>
                    </div>
                @endif
            </p>
            @else
                <p class="text-break fs-3 text-center">
                    You have to finish the test for you to see the result.
                </p>
            @endif

            @if ($errors->any())
            <div>
                <ul class="list-group my-2">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
