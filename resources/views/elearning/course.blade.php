<!-- Content Section -->
<div class="container">
    <h1>{{ $course->name }}</h1>
    <div class="objectives-container">
        <div class="objectives">OBJECTIVES:</div>
        <b>{{ $course->objective }}</b>
    </div>

    <div class="container mb-4">
        {{ $course->description }}
    </div>
    <!-- Responsive Image Container -->
    <h1>TRIVIA</h1>
    <div class="short-background">
        {!! $course->trivia !!}
    </div>
    <h1>Topics</h1>
    <ul>
        @foreach ($related_topics as $topic)
            <li><a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $topic->id }}" class="text-decoration-none">{{ $topic->title }}</a></li>
        @endforeach
    </ul>
</div>