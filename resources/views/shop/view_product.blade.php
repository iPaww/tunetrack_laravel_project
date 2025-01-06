

<div class="container mt-5 pb-5">
    <div class="row align-items-center mb-5">
        <div class="col-mg-12 mb-3">
            <a href="@if ( url()->previous() !== url()->current() && str_contains(url()->previous(), '/shop') ) {{ url()->previous() }} @else /shop @endif"
                class="btn btn-outline-dark border border-0 fw-bold">&laquo; Back to shop</a>
        </div>
        <!-- Product Image -->
        <div class="col-md-6 text-center">

            {{-- code for image --}}
            @if (file_exists(public_path($product->image)))
                <img src="{{ asset($product->image) }}" class="img-fluid border rounded" style="min-width: 100%" alt="{{ ($product->name) }}" />
            @else
                <img src="{{ asset("storage/assets/image/product_image/default.png") }}" class="img-fluid border rounded" style="min-width: 100%" alt="{{ ($product->name) }}" />
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
                    @foreach ( $colors as $color )
                        <div class="me-1 mb-1">
                            <input type="radio" name="colors" class="btn-check" id="btn-check-{{ $color->color_id }}" value="{{ $color->color_id }}" data-max={{ $color->quantity }} autocomplete="off"/>
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
                    <input type="number" class="quantity-inp form-control" min="0" max="999" value="1"/>
                    <button class="quantity-plus-btn btn btn-outline-secondary">+</button>
                </div>
            </div>
            <div class="d-flex">
                <!-- Form to add product to the cart -->
                <form method="POST" action="/shop/cart/add/{{ $product->id }}" style="display: inline; width: fit-content;">
                    <!-- Hidden fields to pass product data -->
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="add_cart" value="1">
                    <input type="hidden" name="color" required>
                    <input type="hidden" name="quantity" value="1" required>

                    <!-- Button to add to cart -->
                    <button class="add-to-cart-btn btn btn-danger me-1" type="submit">Add to Cart</button>
                </form>

                <!-- Other buttons (like Buy Now) can be here as well -->
                <form method="POST" action="/shop/cart/add/{{ $product->id }}" style="display: inline; width: fit-content;">
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
                            <span class="fw-bold text-warning mb-0">4.8<span class="ms-2 text-muted">/5</span></span>
                            
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-12">
                        <div class="row mb-md-0 mb-2">
                            <div class="col-md-2 col-6 order-md-1 order-1">
                                <span class="float-md-end text-warning">★★★★★</span>
                            </div>
                            <div class="col-md-7 col-sm-5 order-md-2 order-3">
                                <div class="position-relative h-100">
                                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                                        <div class="progress w-100" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: 80%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-6 order-md-3 order-2">
                                <span class="text-nowrap text-muted float-md-start float-end w-25">110</span>
                            </div>
                        </div>
                        <div class="row mb-md-0 mb-2">
                            <div class="col-md-2 col-6 order-md-1 order-1">
                                <span class="float-md-end text-warning">★★★★☆</span>
                            </div>
                            <div class="col-md-7 col-sm-5 order-md-2 order-3">
                                <div class="position-relative h-100">
                                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                                        <div class="progress w-100" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: 80%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-6 order-md-3 order-2">
                                <span class="text-nowrap text-muted float-md-start float-end w-25">8</span>
                            </div>
                        </div>
                        <div class="row mb-md-0 mb-2">
                            <div class="col-md-2 col-6 order-md-1 order-1">
                                <span class="float-md-end text-warning">★★★☆☆</span>
                            </div>
                            <div class="col-md-7 col-sm-5 order-md-2 order-3">
                                <div class="position-relative h-100">
                                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                                        <div class="progress w-100" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-6 order-md-3 order-2">
                                <span class="text-nowrap text-muted float-md-start float-end w-25">5</span>
                            </div>
                        </div>
                        <div class="row mb-md-0 mb-2">
                            <div class="col-md-2 col-6 order-md-1 order-1">
                                <span class="float-md-end text-warning">★★☆☆☆</span>
                            </div>
                            <div class="col-md-7 col-sm-5 order-md-2 order-3">
                                <div class="position-relative h-100">
                                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                                        <div class="progress w-100" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: 40%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-6 order-md-3 order-2">
                                <span class="text-nowrap text-muted float-md-start float-end w-25">1</span>
                            </div>
                        </div>
                        <div class="row mb-md-0 mb-2">
                            <div class="col-md-2 col-6 order-md-1 order-1">
                                <span class="float-md-end text-warning">★☆☆☆☆</span>
                            </div>
                            <div class="col-md-7 col-sm-5 order-md-2 order-3">
                                <div class="position-relative h-100">
                                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                                        <div class="progress w-100" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: 40%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-6 order-md-3 order-2">
                                <span class="text-nowrap text-muted float-md-start float-end w-25">1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Reviews -->
        <div class="mt-4">
            <h4 class="fw-bold">Product Reviews</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card card-sm py-0 px-0">
                        <div class="row g-0">
                            <div class="col-md-1 col-sm-12" style="min-height: 5em">
                                <div class="position-relative my-1" style="min-height: 100%">
                                    <img src="{{ asset('/assets/images/default/default_user.png') }}" class="position-absolute top-50 start-50 translate-middle img-fluid border rounded-circle" alt="..." style="max-height: 5rem;">
                                </div>
                            </div>
                            <div class="col-md-11 col-sm-12">
                                <div class="card-body position-relative">
                                    <h6 class="card-title text-warning mb-1">★★★★☆</h6>
                                    <h6 class="card-title fw-bold">Amorganda, Mico</h6>
                                    <span class="card-text mb-0">It arrived in perfect condition, and I appreciated the included accessories, which made it an even better value. This guitar has quickly become my go-to instrument, and I would highly recommend it to anyone looking for a high-quality, reliable guitar. Whether you're a beginner or a seasoned player, this guitar will exceed your expectations!</span>
                                    <span class="position-absolute top-0 end-0 me-4 mt-4"><small class="text-body-secondary">{{ date("F j, Y, g:i a", strtotime('')) }}</small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
        $('input[name="color"]').val( selected_color.val() )
    })
})
</script>