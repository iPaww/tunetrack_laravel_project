<style>
/* General Text Styling */
.text-justify {
    text-align: justify;
}

/* Course Description Styling */
.course-dtext {
    font-size: 1.2rem;
    line-height: 1.6;
}

/* Objectives Section */
.objectives-container {
    background: #fff3e6;
    padding: 20px;
    border-radius: 10px;
    border-left: 5px solid #FC6A03;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.objectives-container:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
}

/* Topics Section Styling */
.topics-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
}

/* Individual Topic Card */
.topic-card {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    text-align: center;
    width: 30%;
    min-width: 200px;
    font-size: 1.1rem;
    font-weight: bold;
}

/* Topic Card Link */
.topic-card a {
    color: #FC6A03;
    text-decoration: none;
    transition: color 0.3s ease-in-out;
}

/* Hover Effects */
.topic-card:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
    background: #ffe5d1;
}

/* Trivia Section */
.short-background {
    background: linear-gradient(135deg, #fff3e6, #ffdab3);
    border-left: 5px solid #ff7300;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    font-weight: bold;
    font-size: large;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Trivia Hover Effect */
.short-background:hover {
    transform: scale(1.02);
    box-shadow: 0px 8px 16px rgba(252, 106, 3, 0.3);
}

/* Mobile Optimization */
@media (max-width: 576px) {
    .topic-card {
        width: 100%;
    }

    .course-dtext {
        font-size: 1rem;
    }
}
</style>

<div>
    <h1 class="fs-1 text-center">{{ $course->name }}</h1>
    <p class="fs-5 text-break text-justify course-dtext fw-semibold">{{ $course->description }}</p>
</div>

<!-- Objectives Section -->
<div class="objectives-container my-4">
    <div class="fs-3 fw-bold">OBJECTIVES</div>
    <p class="text-break text-justify fw-semibold">{{ $course->objective }}</p>
</div>

<!-- Topics Section -->
<div class="mt-4">
    <h1 class="fw-bold text-center">TOPICS</h1>
    <div class="topics-container">
        @foreach ($topics as $topic)
            <div class="topic-card">
                <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $topic->id }}">
                    {{ $topic->title }}
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Trivia Section -->
<div class="short-background my-4">
    <h1 class="fw-bold">TRIVIA</h1>
    <p class="text-break text-justify fw-semibold">{!! $course->trivia !!}</p>
</div>

