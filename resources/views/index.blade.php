<!-- Centered content with titles and search bar -->
<div class="centered-content text-center">
    <form action="{{ route('course.search', ['course' => $course->id]) }}" method="GET" class="d-flex w-50">
        <input type="text" name="query" class="form-control" placeholder="Search Topics..." value="{{ request()->query('query') }}" aria-label="Search Topics">
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>
</div>