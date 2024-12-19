<style>
img {
    width: 50%;  /* Ensures the image takes up the available width */
    max-width: 500px;  /* Limit the maximum size */
    height: auto;  /* Maintain aspect ratio */
}
.card {
    height: 350px; /* Set a fixed height for cards */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
}
.card img {
    max-height: 250px;  /* Adjust this to the desired height */
    object-fit: contain;  /* Ensures the image fits without being stretched */
}
</style>

<div class="container mt-5">
    <div class="row align-items-center mb-5">
        <!-- Product Image -->
        <div class="col-md-6 text-center">
            <img src="{{ $productImage }}" alt="{{ $product['name'] }}" class="img-fluid">
        </div>
        <!-- Product Details -->
        <div class="col-md-6">
            <h3 class="fw-bold">{{ $product['name'] }}</h3>
            <div class="mb-3">
                <label for="colorSelect" class="form-label">Choose a color:</label>
                <select class="form-select" id="colorSelect" name="color">
                    @foreach ( $colors as $color )
                        <option value="{{ htmlspecialchars($color) }}>">
                            {{ htmlspecialchars($color) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex">
                <!-- Form to add product to the cart -->
                <form method="POST" action="add_to_cart.php" style="display: inline;">
                    <!-- Hidden fields to pass product data -->
                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                    <input type="hidden" name="type" value="{{ $product['type_id'] }}">
                    <input type="hidden" name="quantity" value="1"> <!-- Default to 1 -->

                    <!-- Button to add to cart -->
                    <button class="btn btn-danger" type="submit">Add to Cart</button>
                </form>

                <!-- Other buttons (like Buy Now) can be here as well -->
                <form method="GET" action="checkout.php" style="display: inline;">
                    <!-- Hidden fields to pass product data -->
                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                    <input type="hidden" name="type" value="{{ $product['type_id'] }}>">
                    <button class="btn btn-warning me-2" type="submit">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-description mt-5">
        <p>{{ $product['description'] }}</p>
    </div>


    <div class="container mt-5">
        <!-- Ratings Section -->
        <div class="row">
            <div class="col-12">
                <h4 class="fw-bold">Ratings</h4>
                <div class="d-flex align-items-center mb-3">
                    <h1 class="display-4 fw-bold text-warning mb-0">4.8</h1>
                    <span class="fs-4 ms-2 text-muted">/5</span>
                </div>

                <div class="mt-2">
                    <div class="d-flex align-items-center">
                        <span class="text-warning">★★★★★</span>
                        <div class="progress w-50 mx-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 80%;"></div>
                        </div>
                    </div>
                    <span class="text-muted">110</span>
                </div>
                <div class="mt-2">
                    <div class="d-flex align-items-center">
                        <span class="text-warning">★★★★☆</span>
                        <div class="progress w-50 mx-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 80%;"></div>
                        </div>
                        <span class="text-muted">8</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="text-warning">★★★☆☆</span>
                        <div class="progress w-50 mx-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 60%;"></div>
                        </div>
                        <span class="text-muted">5</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="text-warning">★★☆☆☆</span>
                        <div class="progress w-50 mx-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 40%;"></div>
                        </div>
                        <span class="text-muted">1</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Reviews -->
        <div class="row mt-4">
            <div class="col-12">
                <h4 class="fw-bold">Product Reviews</h4>
                <div class="d-flex align-items-start border p-3 mt-2">
                    <div class="me-3">
                        <div class="bg-dark rounded-circle" style="width: 60px; height: 60px;"></div>
                    </div>
                <div>
                <h6 class="fw-bold mb-1">Amorganda, Mico</h6>
                <div class="text-warning mb-2">★★★★☆</div>
                    <p class="mb-1">
                        It arrived in perfect condition, and I appreciated the included accessories, which made it an even better value. This guitar has quickly become my go-to instrument, and I would highly recommend it to anyone looking for a high-quality, reliable guitar. Whether you're a beginner or a seasoned player, this guitar will exceed your expectations!
                    </p>
                    <span class="text-muted small">jan-09-20</span>
                </div>
            </div>
        </div>
    </div>
</div>