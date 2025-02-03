<style>
    /* General Styling */
    .text-justify {
        text-align: justify;
    }

    /* Topic List Styling */
    .topic-list {
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #f1f1f1;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Card Layout */
    .topic-card {
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .topic-card .card-body {
        padding: 20px;
    }

    .col-4 {
        max-width: 300px;
    }

    .col-8 {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Image Styling */
    .topic-image-container {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
        max-width: 100%;
        display: inline-block;
        text-align: center;
    }

    .topic-image {
        max-width: 50%;
        height: auto;
        border-radius: 5px;
    }

    /* Audio & Video Styling */
    audio, video {
        border: 2px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 80%;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    video {
        margin-top: 20px;
        width: 100%;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .topic-card .card-body {
            padding: 15px;
        }

        .col-4 {
            max-width: 100%;
        }

        .col-8 {
            max-width: 100%;
        }

        .topic-image {
            max-width: 90%;
        }

        audio, video {
            max-width: 100%;
        }
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
                <div class="topic-image-container">
                    <img src="{{ asset('storage/' . $topic->image) }}" alt="Topic Image" class="topic-image">
                </div>
            @endif

            <!-- Topic Title -->
            <h3 class="fs-3 fw-bold">{{ $topic->title }}</h3>

            <!-- Topic Description -->
            <p class="text-break text-justify fw-semibold">{!! $topic->description !!}</p>

            <!-- Topic Audio -->
            @if ($topic->audio)
                <div class="mt-4">
                    <audio controls>
                        <source src="{{ asset('storage/' . $topic->audio) }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endif

            <!-- Topic Video -->
            @if ($topic->video)
                <div class="mt-4">
                    <video controls>
                        <source src="{{ asset('storage/' . $topic->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
        </div>
    </div>
</div>
