<h1 class="fs-1 fw-bold">{{ $category->name }}</h1>
<div>
    <ul>
        @foreach ($related_courses as $course)
            <li><a href="/elearning/category/{{ $category->id }}/course/{{ $course->id }}" class="text-decoration-none">{{ $course->name }}</a></li>
        @endforeach
    </ul>
</div>