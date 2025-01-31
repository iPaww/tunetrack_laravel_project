<div>
    <h1 class="fs-1">{{ $course->name }}</h1>
    <p class="text-break"><b>{{ $course->description }}</b></p>
</div>

<div class="objectives-container">
    <div class="fs-3">Objectives</div>
    <p class="text-break">{{ $course->objective }}</p>
</div>

<div class="mt-4">
    <h1>Topics</h1>
    <ul class="row">
        @foreach ($topics as $topic)
            <div class="col-4"><a
                    href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $topic->id }}"
                    class="text-decoration-none">{{ $topic->title }}</a></div>
        @endforeach
    </ul>
</div>

<div class="short-background my-4">
    <h1>Trivia</h1>
    <p class="text-break">{!! $course->trivia !!}</p>
</div>
