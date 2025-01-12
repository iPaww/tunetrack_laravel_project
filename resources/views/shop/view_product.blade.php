<div class="container mt-5 pb-5">
    <div class="row align-items-center mb-5">
        <div class="col-mg-12 mb-3">
            <a href="@if (url()->previous() !== url()->current() && str_contains(url()->previous(), '/shop')) {{ url()->previous() }} @else /shop @endif"
                class="btn btn-outline-dark border border-0 fw-bold">&laquo; Back to shop</a>
        </div>
        <!-- Product Image -->
        <div class="col-md-6 text-center">

            {{-- code for image --}}
            @if (file_exists(public_path($product->image)))
                <img src="{{ asset($product->image) }}" class="img-fluid border rounded" style="min-width: 100%"
                    alt="{{ $product->name }}" />
            @else
                <img src="{{ asset('/assets/images/products/default_product.png') }}" class="img-fluid border rounded"
                    style="min-width: 100%" alt="{{ $product->name }}" />
            @endif


        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h3 class="fw-bold">{{ $product->name }}</h3>
            <h4 class="fw-bold">$ {{ number_format($product->price) }}</h4>
            <div class="w-50">
                <label class="form-label">Brand: {{ $product->brand_name }}</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Choose a color:</label>
                <div class="d-flex flex-wrap">
                    @foreach ($colors as $color)
                        <div class="me-1 mb-1">
                            <input type="radio" name="colors" class="btn-check" id="btn-check-{{ $color->color_id }}"
                                value="{{ $color->color_id }}" data-max={{ $color->quantity }} autocomplete="off" />
                            <label class="btn btn-sm btn-secondary" for="btn-check-{{ $color->color_id }}">
                                <span class="badge text-bg-dark">{{ $color->quantity }}</span>
                                {{ $color->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-50">
                <div class="input-group mb-3">
                    <button class="quantity-minus-btn btn btn-outline-secondary">-</button>
                    <input type="number" class="quantity-inp form-control" min="0" max="999"
                        value="1" />
                    <button class="quantity-plus-btn btn btn-outline-secondary">+</button>
                </div>
            </div>
            <div class="d-flex">
                <!-- Form to add product to the cart -->
                <form method="POST" action="/shop/cart/add/{{ $product->id }}"
                    style="display: inline; width: fit-content;">
                    <!-- Hidden fields to pass product data -->
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="add_cart" value="1">
                    <input type="hidden" name="color" required>
                    <input type="hidden" name="quantity" value="1" required>

                    <!-- Button to add to cart -->
                    <button class="add-to-cart-btn btn btn-danger me-1" type="submit">Add to Cart</button>
                </form>

                <!-- Other buttons (like Buy Now) can be here as well -->
                <form method="POST" action="/shop/cart/add/{{ $product->id }}"
                    style="display: inline; width: fit-content;">
                    <!-- Hidden fields to pass product data -->
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="check_out" value="1">
                    <input type="hidden" name="color" required>
                    <input type="hidden" name="quantity" value="1" required>
                    <button class="but-now-btn btn btn-warning me-2" type="submit">Buy Now</button>
                </form>
            </div>
            @if ($errors->any())
                <ul class="list-group my-2">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (session()->get('data'))
                <ul class="list-group my-2">
                    @foreach (session()->get('data') as $data)
                        <li class="list-group-item list-group-item-success">{{ $data }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="container-description mt-5">
        <p>{!! $product->description !!}</p>
    </div>


    <div class="container mt-5">
        <!-- Ratings Section -->
        <h4 class="fw-bold">Ratings</h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <div class="d-flex align-items-center mb-3 text-nowrap" style="font-size: 5em;">
                            <span class="fw-bold text-warning mb-0">{{ $product_rating }}<span
                                    class="ms-2 text-muted">/5</span></span>

                        </div>
                    </div>
                    <div class="col-md-10 col-sm-12">
                        @foreach ($rating_scores as $index => [$total_rating, $progress])
                            <div class="row mb-md-0 mb-2">
                                <div class="col-md-2 col-6 order-md-1 order-1">
                                    <span class="float-md-end selected-product-rating d-flex"
                                        data-star="{{ 1 + $index }}">
                                        <span class="text-warning user-select-none">☆</span>
                                        <span class="text-warning user-select-none">☆</span>
                                        <span class="text-warning user-select-none">☆</span>
                                        <span class="text-warning user-select-none">☆</span>
                                        <span class="text-warning user-select-none">☆</span>
                                    </span>
                                </div>
                                <div class="col-md-7 col-sm-5 order-md-2 order-3">
                                    <?php [$total_rating_5] = $rating_scores[0]; ?>
                                    <div class="position-relative h-100">
                                        <div class="position-absolute top-50 start-50 translate-middle w-100">
                                            <div class="progress w-100" style="height: 10px;">
                                                <div class="progress-bar bg-warning"
                                                    style="width: {{ $progress }}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-6 order-md-3 order-2">
                                    <span
                                        class="text-nowrap text-muted float-md-start float-end w-25">{{ $total_rating }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Reviews -->
        <div id="product-review" class="mt-4">
            <h4 class="fw-bold">Product Reviews</h4>
            <div class="row">
                @if (count($reviews) > 0)
                    @foreach ($reviews as $review)
                        <div class="col-12 mb-2">
                            <div class="card card-sm py-0 px-0">
                                <div class="row g-0">
                                    <div class="col-md-1 col-sm-12" style="min-height: 5em">
                                        <div class="position-relative my-1" style="min-height: 100%">
                                            @if ($review->user->image && Storage::disk('public')->exists(str_replace('storage/', '', $review->user->image)))
                                                <img src="{{ asset($review->user->image) }}"
                                                    class="position-absolute top-50 start-50 translate-middle img-fluid border rounded-circle"
                                                    style="max-height: 5rem;" />
                                            @else
                                                <img src="{{ asset('/assets/images/default/default_user.png') }}"
                                                    class="position-absolute top-50 start-50 translate-middle img-fluid border rounded-circle"
                                                    alt="{{ $review->user->fullname }}'s image"
                                                    style="max-height: 5rem;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-11 col-sm-12">
                                        <div class="card-body position-relative">
                                            <h6 class="card-title mb-1 selected-product-rating d-flex"
                                                data-star="{{ $review->rating }}">
                                                <span class="text-warning user-select-none">☆</span>
                                                <span class="text-warning user-select-none">☆</span>
                                                <span class="text-warning user-select-none">☆</span>
                                                <span class="text-warning user-select-none">☆</span>
                                                <span class="text-warning user-select-none">☆</span>
                                            </h6>
                                            <h6 class="card-title fw-bold">{{ $review->user->fullname }}</h6>
                                            <span class="card-text mb-0">{{ $review->review }}</span>
                                            <span class="position-absolute top-0 end-0 me-4 mt-4"><small
                                                    class="text-body-secondary">{{ date('F j, Y, g:i a', strtotime($review->created_at)) }}</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">There are no reviews for this product.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        const selected_product_rating_container = $('.selected-product-rating')
        selected_product_rating_container.change((e) => {
            const container = $(e.target)
            const star = parseInt(container.data('star'))
            $('span', container).text('☆')
            $('span', container).slice(0, star).each(function(index, item) {
                const span_2 = $(item)
                span_2.text('★')
            })
        })
        selected_product_rating_container.trigger('change')

        let max_quantity = 999
        $('.quantity-inp').on('input', function() {
            const input = $(this)
            const value = parseInt(input.val())
            if (value > max_quantity)
                input.val(max_quantity)
            else if (value < 0)
                input.val(0)
            $('input[name="quantity"]').val(input.val())
        })
        $('.quantity-minus-btn').click(() => {
            let current_value = parseInt($('.quantity-inp').val()) || 0
            $('.quantity-inp').val(current_value - 1).trigger('input')
        })
        $('.quantity-plus-btn').click(() => {
            let current_value = parseInt($('.quantity-inp').val()) || 0
            $('.quantity-inp').val(current_value + 1).trigger('input')
        })
        $('.btn-check').click((e) => {
            const selected_color = $(e.target)
            max_quantity = selected_color.data('max')
            $('.quantity-inp').trigger('input')
            $('input[name="color"]').val(selected_color.val())
        })

    })
</script>
