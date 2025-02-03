<style>
    .text-justify {
    text-align: justify;
}
</style>
<h1 class="fs-1">{{ $course->name }}</h1>
<p class="fs-5 text-break text-justify fw-semibold">{{ $course->description }}</p>
<h3 class="fs-1">Topics</h3>

<div class="card topic-card">
    <div class="card-body row">
        <!-- Left column: Topics list -->
        <div class="col-4 border-end">
            @foreach ($topics as $rel_topic)
                @if (request()->route('topic_id') == $rel_topic->id)
                    <div class="topic-list active">{{ $rel_topic->title }}</div>
                @else
                    <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $rel_topic->id }}"
                        class="text-decoration-none text-white">
                        <div class="topic-list">{{ $rel_topic->title }}</div>
                    </a>
                @endif
            @endforeach
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz"
                class="text-decoration-none text-white">
                <div class="topic-list">Quiz</div>
            </a>
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/overall"
                class="text-decoration-none text-white">
                <div class="topic-list">Overall</div>
            </a>
        </div>

        <!-- Right column: Topic details -->
        <div class="col-8 text-center">
            <!-- Topic Image -->
            @if ($topic->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $topic->image) }}" alt="Topic Image" class="img-fluid rounded"
                        style="max-width: 30%; height: auto;">
                </div>
            @endif

            <!-- Topic Title -->
            <h3 class="fs-3 fw-bold">{{ $topic->title }}</h3>

            <!-- Topic Description -->
            <p class="text-break text-justify fw-semibold">{!! $topic->description !!}</p>

            <!-- Topic Audio -->
            @if ($topic->audio)
                <div class="mt-4">
                    <audio controls class="w-100">
                        <source src="{{ asset('storage/' . $topic->audio) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endif

            <!-- Topic Video -->
            @if ($topic->video)
            <div class="mt-4">
                <video controls class="w-100" style="max-width: 80%;">
                    <source src="{{ asset('storage/' . $topic->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            @endif
        </div>
    </div>
</div>
