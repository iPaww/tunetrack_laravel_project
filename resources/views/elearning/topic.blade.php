<h1 class="fs-1 fw-bold">{{ $course->name }}</h1>
<p class="fs-4 text-break">{{ $course->description }}</p>
<h3 class="fs-3 fw-bold">Topics</h3>
<div class="card bg-dark text-white">
    <div class="card-body row">
        <div class="col-4">
            <ul>
                @foreach ($related_topics as $rel_topic)
                    <li><a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $rel_topic->id }}" class="text-decoration-none">{{ $rel_topic->title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-8">
            <h3 class="fs-3 fw-bold text-center">{{ $topic->title }}</h3>
            <p class="text-break">{!! $topic->description !!}</p>
        </div>
    </div>
    
</div>