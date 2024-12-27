<h1 class="fw-bold text-center my-5">Courses</h1>
<div class="row">
    @foreach($categories as $category)
    <div class="col-4 mb-5">
        <a href="/elearning/category/{{ $category->id }}" class="text-decoration-none">
            <div class="card">
                <img src="{{ asset('/assets/images/elearning/instruments/string-instruments.jpg') }}" class="card-img-top" alt="..." style="min-height: 6em;">
                <div class="card-body">
                <h5 class="card-title text-center">{{ $category->name }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>