<style>
.btn-elearning {
    color: white;
    background-color: #FC6A03;
    border-color: #FC6A03;
    text-align: center;
    padding: 10px 20px;
    word-wrap: break-word;
    white-space: normal;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    width: 100%;
}

.btn-elearning:hover {
    background-color: #bd4f02;
    border-color: #bd4f02;
}

.btn-elearning:active {
    background-color: #853700 !important;
    border-color: #853700 !important;
}

.card-img-top {
    height: 150px;
    width: 100%;
    object-fit: cover;
    border-radius: 8px;
}

/* Card styling */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect */
.card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Ensure buttons on small screens are more flexible */
@media (max-width: 576px) {
    .btn-elearning {
        font-size: 0.9rem;
        padding: 10px;
        height: 50px;
    }
}

</style>

<h1 class="fw-bold text-center my-5">Courses</h1>
<div class="row">
    @foreach ($categories as $category)
        <div class="col-4 mb-5">
            <a href="/elearning/category/{{ $category->id }}" class="text-decoration-none">
                <div class="card">
                    <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}"
                        style="min-height: 6em;">

                    {{-- <img src="{{ asset('storage/app/public/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}"
                        style="min-height: 6em;"> --}}
                    <div class="card-body">
                    </div>
                </div>
            </a>
            <a href="/elearning/category/{{ $category->id }}"
                class="btn btn-lg btn-elearning text-center rounded-pill w-100 mt-2">{{ $category->name }}</a>
        </div>
    @endforeach
</div>
