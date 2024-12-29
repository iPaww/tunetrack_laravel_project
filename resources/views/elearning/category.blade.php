<h1 class="fs-1 text-center">{{ $category->name }} Courses</h1>
<div>
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-center">{{ $course->name }}</h1>
                            <p class="text-truncate">{{ $course->description }}</p>
                            <div class="text-center">
                                <a href="/elearning/category/{{ $category->id }}/course/{{ $course->id }}" class="btn btn-elearning">Learn More<a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>