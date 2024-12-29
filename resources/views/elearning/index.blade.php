<style>
.btn-elearning {
    color: white;
    background-color: #FC6A03;
    border-color: #FC6A03;
}

.btn-elearning:hover {
    background-color: #bd4f02;
    border-color: #bd4f02;
}

.btn-elearning:active {
    background-color: #853700 !important;
    border-color: #853700 !important;
}
</style>

<h1 class="fw-bold text-center my-5">Courses</h1>
<div class="row">
    @foreach($categories as $category)
    <div class="col-4 mb-5">
        <a href="/elearning/category/{{ $category->id }}" class="text-decoration-none">
            <div class="card">
                <img src="{{ asset('/assets/images/elearning/instruments/string-instruments.jpg') }}" class="card-img-top" alt="{{ $category->name }}" style="min-height: 6em;">
                <div class="card-body">
                </div>
            </div>
        </a>
        <a href="/elearning/category/{{ $category->id }}" class="btn btn-lg btn-elearning text-center rounded-pill w-100 mt-2">{{ $category->name }}</a>
    </div>
    @endforeach
</div>