<style>
/* General Card Styling */
.card {
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    overflow: hidden;
    position: relative;
    background: white;
}

/* Hover Effects: Lift, Rotate & Glow */
.card:hover {
    transform: translateY(-7px) rotate(1deg);
    box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.2);
}

/* Course Title with Underline Animation */
.card h1 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #FC6A03;
    position: relative;
    display: inline-block;
}

/* Underline Effect on Hover */
.card h1::after {
    content: "";
    width: 0;
    height: 3px;
    background-color: #FC6A03;
    position: absolute;
    left: 50%;
    bottom: -5px;
    transition: width 0.3s ease, left 0.3s ease;
}

.card:hover h1::after {
    width: 100%;
    left: 0;
}

/* Course Description with Fade-in Effect */
.card p {
    font-size: 1rem;
    color: #444;
    text-align: justify;
    opacity: 0.85;
    transition: opacity 0.3s ease-in-out;
}

/* Slight Brightening on Hover */
.card:hover p {
    opacity: 1;
}

/* Button Enhancements */
.btn-elearning {
    color: white;
    background-color: #FC6A03;
    border-radius: 50px;
    padding: 12px 24px;
    font-size: 1rem;
    display: inline-block;
    transition: background-color 0.3s ease-in-out, transform 0.3s ease, box-shadow 0.3s ease;
}

/* Button Hover: Glow & Expand */
.btn-elearning:hover {
    background-color: #bd4f02;
    transform: scale(1.08);
    box-shadow: 0px 5px 15px rgba(252, 106, 3, 0.5);
}

/* Mobile Optimization */
@media (max-width: 768px) {
    .col-4 {
        width: 100%;
    }

    .card h1 {
        font-size: 1.3rem;
    }

    .card p {
        font-size: 0.95rem;
    }
}
</style>

<h1 class="fs-1 text-center">{{ $category->name }}</h1>

<div>
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-4 mb-4">
                <a href="/elearning/category/{{ $category->id }}/course/{{ $course->id }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1>{{ $course->name }}</h1>
                            <p class="text-truncate">{{ $course->description }}</p>
                            <div class="text-center">
                                <a href="/elearning/category/{{ $category->id }}/course/{{ $course->id }}" class="btn btn-elearning">Learn More</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

