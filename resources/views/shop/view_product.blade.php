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
        <div class="col-mg-12">
            <a href="/shop" class="btn btn-outline-dark border border-0 fw-bold">&laquo; Back to shop</a>
        </div>
        <!-- Product Image -->
        <div class="col-md-6 text-center">
            <img src="{{ $productImage }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <!-- Product Details -->
        <div class="col-md-6">
            <h3 class="fw-bold">{{ $product->name }}</h3>
            <div class="w-50">
                <label class="form-label">Brand: {{ $product->brand_id }}</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Choose a color:</label>
                @foreach ( $colors as $color )
                    <input type="radio" name="colors" class="btn-check" id="btn-check-{{ $color->color_id }}" value="{{ $color->id }}" data-max={{ $color->quantity }} autocomplete="off"/>
                    <label class="btn btn-sm btn-secondary" for="btn-check-{{ $color->color_id }}">
                        <span class="badge text-bg-dark">{{ $color->quantity }}</span>
                        {{ $color->name }}
                    </label>
                @endforeach
            </div>
            <div class="w-50">
                <div class="input-group mb-3">
                    <button class="quantity-minus-btn btn btn-outline-secondary">-</button>
                    <input type="number" class="quantity-inp form-control" min="0" max="999" value="1"/>
                    <button class="quantity-plus-btn btn btn-outline-secondary">+</button>
                </div>
            </div>
            <div class="d-flex">
                <!-- Form to add product to the cart -->
                <form method="POST" action="/shop/cart/add/{{ $product->id }}" style="display: inline;">
                    <!-- Hidden fields to pass product data -->
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="cc">
                    <input type="hidden" name="quantity" value="1">

                    <!-- Button to add to cart -->
                    <button class="add-to-cart-btn btn btn-danger" type="submit">Add to Cart</button>
                </form>

                <!-- Other buttons (like Buy Now) can be here as well -->
                <form method="GET" action="checkout.php" style="display: inline;">
                    <!-- Hidden fields to pass product data -->
                    <input type="hidden" name="cc">
                    <input type="hidden" name="quantity" value="1">
                    <button class="but-now-btn btn btn-warning me-2" type="submit">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-description mt-5">
        <p>{{ $product->description }}</p>
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
<body>
<script type="text/javascript">
$(document).ready(function() {
    let max_quantity = 999
    $('.quantity-inp').on('input', function() {
        const input = $(this)
        const value = parseInt( input.val() )
        if( value > max_quantity )
            input.val(max_quantity)
        else if( value < 0 )
            input.val(0)
        $('input[name="quantity"]').val( input.val() )
    })
    $('.quantity-minus-btn').click(() => {
        let current_value = parseInt( $('.quantity-inp').val() ) || 0
        $('.quantity-inp').val( current_value - 1 ).trigger('input')
    })
    $('.quantity-plus-btn').click(() => {
        let current_value = parseInt( $('.quantity-inp').val() ) || 0
        $('.quantity-inp').val( current_value + 1).trigger('input')
    })
    $('.btn-check').click((e) => {
        const selected_color = $(e.target)
        max_quantity = selected_color.data('max')
        $('.quantity-inp').trigger('input')
        $('input[name="inventory"]').val( selected_color.val() )
    })
})
</script>