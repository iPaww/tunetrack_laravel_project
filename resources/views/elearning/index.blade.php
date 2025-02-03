<style>
/* Elearning Button */
    .btn-elearning {
        color: white;
        background-color: #FC6A03;
        border: none;
        text-align: center;
        padding: 12px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: 100%;
        border-radius: 50px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s ease-in-out;
    }

    /* Button Hover Effect */
    .btn-elearning:hover {
        background-color: #bd4f02;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(252, 106, 3, 0.4);
    }

    /* Button Active (Click) Effect */
    .btn-elearning:active {
        background-color: #853700 !important;
        transform: scale(0.98);
    }

    /* Card styling */
    .card {
        transition: transform 0.4s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }

    /* Card Hover Effect */
    .card:hover {
        transform: scale(1.08) rotate(1deg);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    /* Card Image Styling */
    .card-img-top {
        height: 150px;
        width: 100%;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }

    /* Mobile Optimization */
    @media (max-width: 576px) {
        .btn-elearning {
            font-size: 0.85rem;
            padding: 10px;
            height: 45px;
        }
    }
</style>

<h1 class="fw-bold text-center my-5">Courses</h1>
<div class="row">
    @foreach ($categories as $category)
        <div class="col-12 col-md-6 col-lg-4 mb-5">
            <a href="/elearning/category/{{ $category->id }}" class="text-decoration-none">
                <div class="card">
                    <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $category->name }}</h5>
                    </div>
                </div>
            </a>
            <a href="/elearning/category/{{ $category->id }}" class="btn btn-lg btn-elearning mt-2">
                {{ $category->name }}
            </a>
        </div>
    @endforeach
</div>
