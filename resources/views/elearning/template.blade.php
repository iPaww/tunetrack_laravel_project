@include('includes/header')

<style>

</style>

<div class="d-flex flex-column flex-lg-row">
    <!-- Sidebar Section -->
    <div class="side-bar">
        <div class="menu-ctgry">
            @foreach ( $sidenav['categories'] as $sidenav_category )
                <a class="text-reset text-decoration-none" 
                data-bs-toggle="collapse" href="#course-{{ $sidenav_category->id }}" role="button" aria-expanded="false" aria-controls="course-{{ $sidenav_category->id }}"
                {{-- href="/elearning/category/{{ $sidenav_category->id }}" --}}
                ><div class="category-sidenav text-capitalize">{{ $sidenav_category->name }}</div></a>
                <div class="courses-div collapse @if( request()->route('id') == $sidenav_category->id ) show @endif" id="course-{{ $sidenav_category->id }}">
                    @foreach ( $sidenav['courses'][$sidenav_category->id] as $sidenav_courses )
                    <a class="text-reset text-decoration-none @if( request()->route('course_id') == $sidenav_courses->id ) active @endif" href="/elearning/category/{{ $sidenav_category->id }}/course/{{ $sidenav_courses->id }}"
                        ><div class="course-sidenav text-capitalize">{{ $sidenav_courses->name }}</div></a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        @include($page)
    </div>
</div>
<!-- end .d-flex .flex-column .flex-lg-row -->
@include('includes/footer')