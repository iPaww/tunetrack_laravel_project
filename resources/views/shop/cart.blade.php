<style>
    .price-text {
        color: #FC6A03;
    }

    .select-payment {
        cursor: pointer;
    }

    .select-payment:hover {
        background-color: #bfbfbf;
    }

    .select-payment:active {
        background-color: #5e5e5e;
    }

    .btn-checkout {
        background-color: #FC6A03;
        border-color: #FC6A03;
    }

    .btn-checkout:hover {
        background-color: #bd4f02;
        border-color: #bd4f02;
    }

    .btn-checkout:active {
        background-color: #853700 !important;
        border-color: #853700 !important;
    }
</style>

<div class="container align-items-center min-vh-100 py-5">
    <div class="mb-3">
        <a href="/shop" class="btn btn-outline-dark border border-0 fw-bold">&laquo; Back to shop</a>
    </div>
    <h1 class="display-4 mb-4">Your Shopping Cart</h1>
    <div>
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
    <div class="row">
        <div class="col-md-8">
            @if (count($items) == 0)
                <div class="alert alert-warning" role="alert">
                    Your cart is empty.
                </div>
            @else
                <div class="row">
                    @foreach ($items as $item)
                        <div class="col-12 row mb-1 py-3">
                            <div class="col-3 ">
                                <a href="/shop/product/{{ $item->product_id }}/view"
                                    class="text-decoration-none  w-100">
                                    {{-- <img src="{{ asset('/assets/images/inventory/uploads/' . $item->image ) }}" alt="{{ $item['product_name'] }}" class="img-fluid border rounded"> --}}
                                    @if (file_exists(public_path($item->image)))
                                        <img src="{{ asset($item->image) }}" class="img-fluid border rounded"
                                            alt="{{ htmlspecialchars($item->name) }}" />
                                    @else
                                        <img src="{{ asset('storage/assets/image/product_image/default.png') }}"
                                            class="img-fluid border rounded"
                                            alt="{{ htmlspecialchars($item->name) }}" />
                                    @endif

                                </a>
                            </div>
                            <div class="col-9 row">
                                <div class="col-5 row">
                                    <div class="col-12"><a href="/shop/product/{{ $item->product_id }}/view"
                                            class="fw-bold fs-5 text-decoration-none">{{ $item->name }}</a></div>
                                    <div class="col-12">Color: {{ $item->color_name }}</div>
                                </div>
                                <div class="col-7 pt-4 position-relative">
                                    <form action="/shop/cart/edit/{{ $item->id }}" method="POST">
                                        @csrf <!-- {{ csrf_field() }} -->
                                        <div class="d-flex">
                                            <span class="my-auto me-1">Qty:</span>
                                            <div class="input-group flex-nowrap">
                                                <button type="button"
                                                    class="quantity-minus-btn btn btn-sm btn-outline-secondary">-</button>
                                                <input type="number" class="quantity-inp form-control" name="quantity"
                                                    min="1" max="999" value="{{ $item->quantity }}"
                                                    data-original-value="{{ $item->quantity }}"
                                                    style="min-width: 2em;" />
                                                <button type="button"
                                                    class="quantity-plus-btn btn btn-sm btn-outline-secondary">+</button>
                                                <button type="submit" class="btn btn-sm btn-primary update-btn"
                                                    disabled>Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="my-auto me-1 price-text text-end w-100 mt-2">
                                        ₱{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                    <form action="/shop/cart/remove/{{ $item->cart_id }}" method="POST">
                                        @csrf <!-- {{ csrf_field() }} -->
                                        <button
                                            class="btn btn-sm btn-outline-danger border-0 rounded-circle position-absolute top-0 end-0 me-2"
                                            style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .3rem;">X</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">{{ $items->links() }}</div>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <h1 class="fw-bold">Select Payment Method</h1>
                </div>
                <div class="col-12 mb-1">
                    <div class="card select-payment">
                        <div class="card-body position-relative">
                            <div class="card-title">Cash</div>
                            <small class="text-muted">Pay when you recieve</small>
                            <input type="radio" name="payment_method_slc"
                                class="form-check-input position-absolute end-0 top-50 translate-middle" checked>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <div class="card bg-dark-subtle">
                        <div class="card-body position-relative">
                            <div class="card-title">GCash (not available)</div>
                            <small class="text-muted">Pay now and get the item in shop</small>
                            <input type="radio" name="payment_method_slc"
                                class="form-check-input position-absolute end-0 top-50 translate-middle" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h1 class="fw-bold">Order Summary</h1>
                    <div class="row">
                        <div class="col-6">Sub total</div>
                        <div class="col-6 text-end">₱ {{ number_format($total_price, 2) }}</div>
                        <div class="col-6">Discount</div>
                        <div class="col-6 text-end">₱ 0</div>
                        <div class="col-6">
                            <h4 class="fw-bold">Total</h4>
                        </div>
                        <div class="col-6 text-end">₱ {{ number_format($total_price, 2) }}</div>
                        <div class="col-12 text-center mt-4">
                            <form action="/shop/cart/check_out" method="POST">
                                @csrf <!-- {{ csrf_field() }} -->
                                <input type="hidden" name="payment_method" value="1" />
                                <button class="btn btn-xl btn-primary btn-checkout w-75">PLACE ORDER NOW</button>
                            </form>
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
            const update_btn = input.parent().find('.update-btn')
            const value = parseInt(input.val())
            const orignal_value = parseInt(input.data('original-value'))
            if (value > max_quantity)
                input.val(max_quantity)
            else if (value < 1)
                input.val(1)
            if (orignal_value != value) {
                input.addClass('bg-warning-subtle')
                update_btn.prop('disabled', false)
            } else {
                input.removeClass('bg-warning-subtle')
                update_btn.prop('disabled', true)
            }
        })
        $('.quantity-minus-btn').click((e) => {
            const current_btn = $(e.target)
            const input_target = current_btn.parent().find('.quantity-inp')
            const current_value = parseInt(input_target.val()) || 0
            input_target.val(current_value - 1).trigger('input')
        })
        $('.quantity-plus-btn').click((e) => {
            const current_btn = $(e.target)
            const input_target = current_btn.parent().find('.quantity-inp')
            const current_value = parseInt(input_target.val()) || 0
            input_target.val(current_value + 1).trigger('input')
        })
    })
</script>
