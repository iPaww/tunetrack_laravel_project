<h1 class="fs-1">{{ $course->name }}</h1>
<p class="fs-4 text-break">{{ $course->description }}</p>
<h3 class="fs-3">Topics</h3>
<div class="card topic-card">
    <div class="card-body row">
        <div class="col-4 border-end">
            @foreach ($topics as $rel_topic)
                @if (request()->route('topic_id') == $rel_topic->id)
                    <div class="topic-list active">{{ $rel_topic->title }}</div>
                @else
                    <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $rel_topic->id }}" class="text-decoration-none text-white">
                        <div class="topic-list">{{ $rel_topic->title }}</div>
                    </a>
                @endif
            @endforeach
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz" class="text-decoration-none text-white">
                <div class="topic-list">Quiz</div>
            </a>
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/overall" class="text-decoration-none text-white">
                <div class="topic-list">Overall</div>
            </a>
        </div>
        <div class="col-8">
            <h3 class="fs-3 fw-bold text-center">{{ $topic->title }}</h3>
            <p class="text-break">{!! $topic->description !!}</p>
        </div>
    </div>
    
</div>