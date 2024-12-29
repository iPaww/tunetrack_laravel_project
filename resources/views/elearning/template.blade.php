@include('includes/header')
<link rel="stylesheet" href="{{ asset('/assets/css/elearning.css') }}">

<div class="d-flex flex-column flex-lg-row">
    <!-- Sidebar Section -->
    <div class="side-bar">
        <div class="menu-ctgry">
            @foreach ( $categories as $sidenav_category )
                @if( request()->route('id') == $sidenav_category->id )
                    <a class="text-reset text-decoration-none" data-bs-toggle="collapse" 
                        href="course-{{ $sidenav_category->id }}" role="button" aria-expanded="false" aria-controls="course-{{ $sidenav_category->id }}">
                        <div class="category-sidenav active text-capitalize">{{ $sidenav_category->name }}</div>
                    </a>
                    <div class="courses-div collapse show" id="course-{{ $sidenav_category->id }}">
                        @foreach ( $courses as $sidenav_courses )
                            @if( request()->route('course_id') == $sidenav_courses->id )
                                <a class="text-reset text-decoration-none" data-bs-toggle="collapse" 
                                    href="course-{{ $sidenav_courses->id }}" role="button" aria-expanded="false" aria-controls="course-{{ $sidenav_courses->id }}">
                                    <div class="course-sidenav active text-capitalize">{{ $sidenav_courses->name }}</div>
                                </a>
                                <div class="topics-div collapse show" id="course-{{ $sidenav_courses->id }}">
                                    @foreach ( $topics as $sidenav_topics )
                                        @if( request()->route('topic_id') == $sidenav_topics->id )
                                            <div class="topic-sidenav active text-capitalize">{{ $sidenav_topics->title }}</div>
                                        @else
                                            <a class="text-reset text-decoration-none"
                                                href="/elearning/category/{{ $sidenav_category->id }}/course/{{ $sidenav_courses->id }}/topic/{{ $sidenav_topics->id }}"
                                            >
                                                <div class="topic-sidenav text-capitalize">{{ $sidenav_topics->title }}</div>
                                            </a>
                                        @endif
                                    @endforeach
                                    <a class="text-reset text-decoration-none"
                                        href="/elearning/category/{{ $sidenav_category->id }}/course/{{ $sidenav_courses->id }}/quiz"
                                    >
                                        <div class="topic-sidenav text-capitalize @if( str_contains(url()->current(), '/quiz') ) active @endif">Quiz</div>
                                    </a>
                                    <a class="text-reset text-decoration-none"
                                        href="/elearning/category/{{ $sidenav_category->id }}/course/{{ $sidenav_courses->id }}/overall"
                                    >
                                        <div class="topic-sidenav text-capitalize @if( str_contains(url()->current(), '/overall') ) active @endif">Overall</div>
                                    </a>
                                </div>
                            @else
                                <a class="text-reset text-decoration-none" href="/elearning/category/{{ $sidenav_category->id }}/course/{{ $sidenav_courses->id }}">
                                    <div class="course-sidenav text-capitalize">{{ $sidenav_courses->name }}</div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @else
                    <a class="text-reset text-decoration-none" href="/elearning/category/{{ $sidenav_category->id }}">
                        <div class="category-sidenav text-capitalize">{{ $sidenav_category->name }}</div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="container py-4">
        @include($page)
    </div>
</div>

<script type="text/javascript" src="{{ asset('/assets/js/elearning/index.js') }}"></script>

<!-- end .d-flex .flex-column .flex-lg-row -->
@include('includes/footer')